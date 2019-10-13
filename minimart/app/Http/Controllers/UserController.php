<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileSettingRequest;
use App\User;

class UserController extends Controller
{
    public function update(ProfileSettingRequest $request, $id)
    {

        // DBよりURIパラメータと同じIDを持つUsersの情報を取得
        $user = User::findOrFail($id);

        // アバター画像名を生成
        $avatar_img_name = 'user' . $id . '.jpg';

        // ヘッダー画像名を生成
        $header_img_name = 'header' . $id . '.jpg';

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
                $user->avatar_img_src = '/storage/avatar_img/' . $avatar_img_name;

                // 画像をストレージに上書き保存
                $request->avatar_img->storeAs('public/avatar_img', $avatar_img_name);
            }

            // ヘッダー画像が送信された場合
            if (!empty($request->header_img)) {

                // ヘッダー画像にパスをセット
                $user->header_img_src = '/storage/header_img/' . $header_img_name;

                // 画像をストレージに上書き保存
                $request->header_img->storeAs('public/header_img', $header_img_name);
            }

            $user->save();
        });

        return redirect("mypage");
    }
}
