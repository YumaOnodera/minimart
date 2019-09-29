<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\MypageRequest;
use App\Goods;
use App\Category;

class MypageController extends Controller
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
            'goods.like_count',
            'goods.created_at',
            'category.category_name'
            )
            ->join('category','goods.category','=','category.category_id')
            ->where('goods.introducer', $id)
            ->orderBy('goods.like_count', 'desc')
            ->orderBy('goods.created_at', 'desc')
            ->get();

        // 取得した値をビュー「mypage/index」に渡す
        return view('mypage/index', compact('goods'));
    }

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
            'goods.updated_at',
            'users.user_name',
            'users.user_img_src',
            'category.category_name'
            )
            ->join('users','goods.introducer','=','users.id')
            ->join('category','goods.category','=','category.category_id')
            ->whereNull('users.deleted_at')
            ->findOrFail($id);

        // 取得した値をビュー「mypage/show」に渡す
        return view('mypage/show', compact('goods'));
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

    public function store(MypageRequest $request)
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

        // セッションに成功メッセージを渡す
        session()->flash('flash_message', '商品の登録が完了しました。');

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

    public function update(MypageRequest $request, $id)
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

        // セッションに成功メッセージを渡す
        session()->flash('flash_message', '商品情報の更新が完了しました。');

        return redirect("/mypage/" . $id . "/edit");
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);
        $goods->delete();

        // セッションに成功メッセージを渡す
        session()->flash('flash_message', '商品の削除が完了しました。');

        return redirect("/mypage");
    }
}
