<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use Carbon\Carbon;

class ForceDeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:force-delete-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '削除してから30日が経過した論理削除ユーザーを物理削除するバッチ処理';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();

        $users = User::onlyTrashed()->get();

        foreach($users as $user) {

            $posts = Post::where('posts.introducer', $user->id)->get();

            $deleted_at = new Carbon($user->deleted_at);

            if($deleted_at->diffInDays($now) > 30) {

                DB::transaction(function () use ($user, $posts) {

                    $user->forceDelete();

                    foreach($posts as $post) {
                        $post->forceDelete();
                    }
    
                });
            }

        }
    }
}
