<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountSettingRequest;
use App\User;

class AccountSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();
        
        // DBよりログインユーザーのIDと同じIDを持つUsersの情報を取得
        $user = User::select(
            'users.user_id',
            'users.user_name',
            'users.email',
            'users.password',
            )
            ->findOrFail($user_id);

        // 取得した値をビュー「/setting/account/edit」に渡す
        return view('/setting/account/edit', compact('user'));
    }

    public function update(AccountSettingRequest $request)
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        // ログインユーザーのIDに紐付くUsersの情報を取得
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

        return redirect("/setting/account");
    }
}
