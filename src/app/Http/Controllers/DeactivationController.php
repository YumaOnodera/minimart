<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Likes;
use App\Post;
use App\User;

class DeactivationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/setting/account/confirm_deactivation/index');
    }

    // 論理削除
    public function delete(Request $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        // パスワードが一致した場合
        if (Hash::check($request->password, $user->password)) {

            // 退会するユーザーがいいねしたPostの情報を取得
            $liked_posts = Post::join('likes','goods.goods_id','=', 'likes.liked_post')
            ->where('likes.liked_user', $user_id)
            ->get();

            // トランザクション処理
            DB::transaction(function () use ($liked_posts, $user) {

                foreach($liked_posts as $liked_post) {
                    // 退会するユーザーがいいねしたPostのいいね数を減らす
                    $liked_post->like_count -= 1;
                    $liked_post->save();
                }

                // ユーザー情報を論理削除
                $user->delete();

                // セッションに成功メッセージを渡す
                session()->flash('flash_message', '退会処理が完了しました。');

            });

            return redirect("/");

        // パスワードが一致しなかった場合
        } else {

            // セッションにエラーメッセージを渡す
            session()->flash('error_message', 'パスワードが一致しません。');

            return redirect("/setting/account/confirm_deactivation");
        }
    }

    // 物理削除（通常は不使用）
    public function destroy(Request $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        // パスワードが一致した場合
        if (Hash::check($request->password, $user->password)) {

            // 退会するユーザーがいいねしたPostの情報を取得
            $liked_posts = Post::join('likes','goods.goods_id','=', 'likes.liked_post')
                ->where('likes.liked_user', $user_id)
                ->get();

            // ユーザーのIDに紐付くPostの情報を取得
            $goods = Post::where('goods.introducer', $user_id);

            // トランザクション処理
            DB::transaction(function () use ($liked_posts, $goods, $user) {

                foreach($liked_posts as $liked_post) {
                    // 退会するユーザーがいいねしたPostのいいね数を減らす
                    $liked_post->like_count -= 1;
                    $liked_post->save();
                }

                // ユーザーが投稿した商品情報を削除
                $goods->forceDelete();

                // ユーザー情報を削除
                $user->forceDelete();

                // セッションに成功メッセージを渡す
                session()->flash('flash_message', 'アカウント情報の削除が完了しました。');

            });

            return redirect("/");
            
        // パスワードが一致しなかった場合
        } else {

            // セッションにエラーメッセージを渡す
            session()->flash('error_message', 'パスワードが一致しません。');

            return redirect("/setting/account/confirm_deactivation");
        }
    }
}
