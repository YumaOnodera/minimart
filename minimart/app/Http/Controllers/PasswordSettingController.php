<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordSettingRequest;
use App\User;

class PasswordSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('/setting/password/edit');
    }

    public function update(PasswordSettingRequest $request)
    {

        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        // ログインユーザーのIDに紐付くUsersの情報を取得
        $user = User::findOrFail($user_id);

        // パスワードを更新
        $user->password = Hash::make($request->new_password);
        $user->save();

        // セッションに成功メッセージを渡す
        session()->flash('flash_message', 'パスワードの更新が完了しました。');

        return redirect("/setting/password");
    }
}
