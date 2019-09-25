<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Goods;

class HomeController extends Controller
{
    
    public function index()
    {
        
        // Goodsテーブルの値を取得
        $goods = Goods::select(
            'goods.goods_id',
            'goods.goods_name',
            'goods.goods_description',
            'goods.introducer',
            'goods.goods_url',
            'goods.goods_img_src',
            'goods.like_count',
            'goods.created_at',
            'users.user_name',
            'category.category_name'
            )
            ->join('users','goods.introducer','=','users.id')
            ->join('category','goods.category','=','category.category_id')
            ->whereNull('users.deleted_at')
            ->orderBy('goods.like_count', 'desc')
            ->orderBy('goods.created_at', 'desc')
            ->get();

        // 取得した値をビュー「home」に渡す
        return view('home', compact('goods'));

    }
}
