<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\MypageRequest;
use App\User;
use App\Goods;
use App\Category;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $err_msg = [
            "goods.category" => "カテゴリーは正しい形式で入力してください。"
        ];

        return Validator::make($data, [
            'goods_name'        => 'required|string|max:50',
            'goods_description' => 'required|string|max:500',
            'category'          => 'required|integer|max:3',
            'goods_url'         => 'required|string|max:1000',
            'goods_img_src'     => 'required|string|max:1000',
        ], $err_msg);
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
            'goods.created_at',
            'category.category_name'
            )
            ->join('category','goods.category','=','category.category_id')
            ->where('goods.introducer', $id)
            ->orderBy('goods.created_at', 'desc')
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

        return redirect("/mypage");
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);
        $goods->delete();

        return redirect("/mypage");
    }
}
