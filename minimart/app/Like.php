<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $primaryKey = 'id';

    public function getLikedUser($goods_id, $user_id)
    {
        // Goodsテーブルの値を取得
        $like = $this::select(
            'likes.liked_user'
        )
        ->where('likes.liked_goods', $goods_id)
        ->where('likes.liked_user', $user_id)
        ->first();
        
        return $like;
    }
}
