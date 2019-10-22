<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $primaryKey = 'id';

    public function getLikedUser($post_id, $user_id)
    {
        $like = $this::select(
            'likes.liked_user'
        )
        ->where('likes.liked_post', $post_id)
        ->where('likes.liked_user', $user_id)
        ->first();
        
        return $like;
    }

    public function getTotalLikeCount($user_id)
    {
        $totalLikeCount = $this::select(
            'likes.id'
        )
        ->where('likes.liked_user', $user_id)
        ->count();
        
        return $totalLikeCount;
    }
}
