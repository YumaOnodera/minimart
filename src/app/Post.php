<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    public function getTotalPostCount($user_id)
    {
        $totalPostCount = $this::select(
            'posts.post_id'
        )
        ->where('posts.introducer', $user_id)
        ->count();
        
        return $totalPostCount;
    }

    public function checkSelectedCategory($post_category, $category_id) {

        if ($post_category == $category_id) {
            return 'selected';
        }

        return '';
    }
}
