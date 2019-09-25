<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Likes;
use App\Goods;
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

    public function destroy(Request $request)
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        // ログインユーザーのIDに紐付くUsersの情報を取得
        $user = User::findOrFail($user_id);

        // パスワードが一致した場合
        if (Hash::check($request->password, $user->password)) {

            // 退会するユーザーがいいねしたGoodsの情報を取得
            $liked_goods = Goods::join('likes','goods.goods_id','=', 'likes.liked_goods')
                ->where('likes.liked_user', $user_id)
                ->get();

            foreach($liked_goods as $liked_item) {
                // 退会するユーザーがいいねしたGoodsのいいね数を減らす
                $liked_item->like_count -= 1;
                $liked_item->save();
            }

            // ユーザーのIDに紐付くGoodsの情報を取得
            $goods = Goods::where('goods.introducer', $user_id);

            // ユーザーが投稿した商品情報を削除
            $goods->delete();

            // ユーザー情報を削除
            $user->delete();

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', 'アカウント情報の削除が完了しました。');

            return redirect("/");
            
        // パスワードが一致しなかった場合
        } else {

            // セッションにエラーメッセージを渡す
            session()->flash('password_error', 'パスワードが一致しません。');

            return redirect("/setting/account/confirm_deactivation");
        }
    }
}
