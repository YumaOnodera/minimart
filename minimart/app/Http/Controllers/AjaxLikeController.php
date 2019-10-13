<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Goods;
use App\Like;

class AjaxLikeController extends Controller
{

    public function update(Request $request) {
        
        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        // Goodsテーブルの中からいいねを押した商品の情報を取得
        $goods = Goods::select('goods.like_count', 'goods.goods_id')
            ->where('goods.goods_id', $request->goods_id)
            ->first();

        // Likeテーブルの中からいいねを押した商品の情報を取得
        $like = Like::select(
            'likes.id',
            'likes.liked_user',
            'likes.liked_goods'
            )
            ->join('users','likes.liked_user','=', 'users.id')
            ->join('goods','likes.liked_goods','=', 'goods.goods_id')
            ->where([
                ['likes.liked_user', $user_id],
                ['likes.liked_goods', $request->goods_id]
            ])
            ->first();
        
        // いいねを押した商品がまだ登録されていなかった場合
        if (empty($like)){

            // トランザクション処理
            DB::transaction(function () use ($user_id, $request, $goods) {

                // Likeテーブルにいいねを押した商品の情報を登録
                $new_like = new Like();
                $new_like->liked_user = (int)$user_id;
                $new_like->liked_goods = (int)$request->goods_id;
                $new_like->save();

                // いいねを押した商品のいいね数を加算
                $goods->like_count += 1;
                $goods->save();

            });
        }
        // いいねを押した商品がすでに登録されていた場合
        else {

            // トランザクション処理
            DB::transaction(function () use ($like, $goods) {

                // いいねを押した商品をLikeテーブルの中から削除
                $like->delete();

                // いいねを押した商品のいいね数を減算
                $goods->like_count -= 1;
                $goods->save();

            });
        }
    }
}
