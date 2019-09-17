<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Goods;
use App\Category;

class GoodsController extends Controller
{
    public function show($id)
    {
        // DBよりURIパラメータと同じIDを持つGoodsの情報を取得
        $goods = Goods::select(
            'goods.goods_id',
            'goods.goods_name',
            'goods.goods_description',
            'goods.introducer',
            'goods.goods_url',
            'goods.goods_img_src',
            'goods.like_count',
            'users.user_name',
            'category.category_name'
            )
            ->join('users','goods.introducer','=','users.id')
            ->join('category','goods.category','=','category.category_id')
            ->findOrFail($id);

        return view('goods/show', compact('goods'));
    }
}
