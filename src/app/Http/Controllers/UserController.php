<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\User;
use App\Post;

class UserController extends Controller
{

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user_id = $user->user_id;

        // アバター画像名を生成
        $avatar_img_name = 'avatar' . $id . '.png';

        // ヘッダー画像名を生成
        $header_img_name = 'header' . $id . '.png';

        // トランザクション処理
        DB::transaction(function () use ($user, $request, $avatar_img_name, $header_img_name) {

            $user->user_name = $request->user_name;
            $user->introduction = $request->introduction;

            // サイトURLが送信された場合
            if (!empty($request->site_url)) {
                $user->site_url = $request->site_url;
            }
            else {
                $user->site_url = NULL;
            }

            // アバター画像が送信された場合
            if (!empty($request->avatar_img)) {

                // アバター画像にパスをセット
                $user->avatar_img_src = 'avatar_img/' . $avatar_img_name;

                // 画像をストレージに上書き保存
                $request->avatar_img->storeAs('public/avatar_img', $avatar_img_name);
            }

            // ヘッダー画像が送信された場合
            if (!empty($request->header_img)) {

                // ヘッダー画像にパスをセット
                $user->header_img_src = 'header_img/' . $header_img_name;

                // 画像をストレージに上書き保存
                $request->header_img->storeAs('public/header_img', $header_img_name);
            }

            $user->save();
        });

        return redirect("/" . $user_id);
    }

    public function accountEdit()
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        return view('/settings/account/edit', compact('user'));
    }

    public function accountUpdate(AccountUpdateRequest $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        // トランザクション処理
        DB::transaction(function () use ($user, $request) {

            // アカウント情報を更新
            $user->user_id = $request->user_id;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->save();

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', 'アカウント情報の更新が完了しました。');
        });

        return redirect("/settings/account");
    }

    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        // トランザクション処理
        DB::transaction(function () use ($user, $request) {

            // パスワードを更新
            $user->password = Hash::make($request->new_password);
            $user->save();

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', 'パスワードの更新が完了しました。');
        });

        return redirect("/settings/password");
    }

    public function delete(Request $request)
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);

        // パスワードが一致した場合
        if (Hash::check($request->password, $user->password)) {

            // 退会するユーザーがいいねしたPostの情報を取得
            $liked_posts = Post::join('likes','posts.post_id','=', 'likes.liked_post')
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

            return redirect("/settings/account/confirm_deactivation");
        }
    }
}
