<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::withTrashed()
                    ->where('users.email', $request->email)
                    ->first();

        // 復活するユーザーのいいねしたPostの情報を取得
        $liked_posts = Post::join('likes','posts.post_id','=','likes.liked_post')
        ->where('likes.liked_user', $user->id)
        ->get();

        // 論理削除済みのユーザーがログインした場合、アカウントを復活させる
        if (!empty($user) && Hash::check($request->password, $user->password)) {

            DB::transaction(function () use ($liked_posts, $user) {

                if (!empty($liked_posts)) {

                    foreach($liked_posts as $liked_post) {

                        // 復活するユーザーがいいねしたPostのいいね数を元に戻す
                        $liked_post->like_count += 1;
                        $liked_post->save();
                    }

                }

                $user->restore();
            });
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
}
