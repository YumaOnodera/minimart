<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Like;

class AjaxLikeController extends Controller
{

    public function update(Request $request) {
        
        $user_id = Auth::id();

        // Postsテーブルの中からいいねを押した商品の情報を取得
        $post = Post::select('posts.like_count', 'posts.post_id')
            ->where('posts.post_id', $request->post_id)
            ->first();

        // Likeテーブルの中からいいねを押した商品の情報を取得
        $like = Like::select(
            'likes.id',
            'likes.liked_user',
            'likes.liked_post'
            )
            ->join('users','likes.liked_user','=', 'users.id')
            ->join('posts','likes.liked_post','=', 'posts.post_id')
            ->where([
                ['likes.liked_user', $user_id],
                ['likes.liked_post', $request->post_id]
            ])
            ->first();
        
        // いいねを押した商品がまだ登録されていなかった場合
        if (empty($like)){

            // トランザクション処理
            DB::transaction(function () use ($user_id, $request, $post) {

                // Likeテーブルにいいねを押した商品の情報を登録
                $new_like = new Like();
                $new_like->liked_user = (int)$user_id;
                $new_like->liked_post = (int)$request->post_id;
                $new_like->save();

                // いいねを押した商品のいいね数を加算
                $post->like_count += 1;
                $post->save();

            });
        }
        // いいねを押した商品がすでに登録されていた場合
        else {

            // トランザクション処理
            DB::transaction(function () use ($like, $post) {

                // いいねを押した商品をLikeテーブルの中から削除
                $like->delete();

                // いいねを押した商品のいいね数を減算
                $post->like_count -= 1;
                $post->save();

            });
        }
    }
}
