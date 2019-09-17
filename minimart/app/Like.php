<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $primaryKey = 'id';

    // public function getLikedUser($user_id, $item)
    // {
    //     // Goodsテーブルの値を取得
    //     $like = Like::select(
    //         'likes.liked_user'
    //     )
    //     ->where('likes.liked_user', $user_id)
    //     ->where('likes.liked_goods', $item)
    //     ->first();

    //     return $this->liked_user;
    // }
}
