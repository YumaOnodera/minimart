<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Goods;
use App\Category;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // ログインユーザーのIDを取得
        $id = Auth::id();

        // DBよりGoodsテーブルの値を取得
        $goods = Goods::select(
            'goods.goods_id',
            'goods.goods_name',
            'goods.goods_description',
            'goods.introducer',
            'goods.goods_url',
            'goods.goods_img_src',
            'category.category_name'
            )
            ->join('category','goods.category','=','category.category_id')
            ->where('goods.introducer', $id)
            ->get();

        // 取得した値をビュー「mypage/index」に渡す
        return view('mypage/index', compact('goods'));
    }
    
    public function create()
    {
        // 空のGoodsを渡す
        $goods = new Goods();

        $categories = Category::select(
            'category.category_id',
            'category.category_name'
            )
            ->get();

        return view('mypage/create', compact('goods', 'categories'));
    }

    public function store(Request $request)
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        $goods = new Goods();
        $goods->goods_name = $request->goods_name;
        $goods->goods_description = $request->goods_description;
        $goods->category = $request->category;
        $goods->introducer = $user_id;
        $goods->goods_url = $request->goods_url;
        $goods->goods_img_src = $request->goods_img_src;
        $goods->save();

        return redirect("/mypage");
    }

    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つGoodsの情報を取得
        $goods = Goods::select(
            'goods.goods_id',
            'goods.goods_name',
            'goods.goods_description',
            'goods.introducer',
            'goods.goods_url',
            'goods.goods_img_src',
            'category.category_name'
            )
            ->join('category','goods.category','=','category.category_id')
            ->findOrFail($id);

        $categories = Category::select(
            'category.category_id',
            'category.category_name'
            )
            ->get();

        // 取得した値をビュー「mypage/edit」に渡す
        return view('mypage/edit', compact('goods', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        $goods = Goods::findOrFail($id);
        $goods->goods_name = $request->goods_name;
        $goods->goods_description = $request->goods_description;
        $goods->category = $request->category;
        $goods->introducer = $user_id;
        $goods->goods_url = $request->goods_url;
        $goods->goods_img_src = $request->goods_img_src;
        $goods->save();

        return redirect("/mypage");
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);
        $goods->delete();

        return redirect("/mypage");
    }
}
