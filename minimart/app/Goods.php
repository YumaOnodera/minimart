<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';

    protected $primaryKey = 'goods_id';

    public function getTotalPostCount($user_id)
    {
        // Goodsテーブルの値を取得
        $totalPostCount = $this::select(
            'goods.goods_id'
        )
        ->where('goods.introducer', $user_id)
        ->count();
        
        return $totalPostCount;
    }
}
