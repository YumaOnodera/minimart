<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsStoreRequest;
use App\Http\Requests\GoodsUpdateRequest;
use App\User;
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

        // DBよりUsersテーブルの値を取得
        $user = User::select(
            'users.user_id',
            'users.user_name'
            )
            ->findOrFail($id);

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
        return view('mypage/index', compact('user', 'goods'));
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
            'users.avatar_img_src',
            'users.header_img_src',
            'users.site_url',
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

    public function store(GoodsStoreRequest $request)
    {

        // アップロードに成功しているか確認
        if(!empty($request->file('goods_img'))) {

            // ログインユーザーのIDを取得
            $user_id = Auth::id();

            // 商品画像名生成用にgoods_idの最大値を取得
            $max_goods_id = Goods::select(
                'goods.goods_id'
                )
                ->max('goods_id');

            // 商品画像名を生成
            $new_goods_id = $max_goods_id + 1;
            $goods_img_name = 'goods' . $new_goods_id . '.jpg';

            // トランザクション処理
            DB::transaction(function () use ($request, $user_id, $goods_img_name) {

                $goods = new Goods();
                $goods->goods_name = $request->goods_name;
                $goods->goods_description = $request->goods_description;
                $goods->category = $request->category;
                $goods->introducer = $user_id;
                $goods->goods_url = $request->goods_url;
                $goods->goods_img_src = '/storage/goods_img/' . $goods_img_name;
                $goods->save();

                // 画像をストレージに保存
                $request->goods_img->storeAs('public/goods_img', $goods_img_name);

                // セッションに成功メッセージを渡す
                session()->flash('flash_message', '商品の登録が完了しました。');

            });

        }
        else {
            // セッションに失敗メッセージを渡す
            session()->flash('error_message', '商品画像のアップロードに失敗しました');

            return redirect("/mypage/create");
        }

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

    public function update(GoodsUpdateRequest $request, $id)
    {

        // ログインユーザーのIDを取得
        $user_id = Auth::id();

        // DBよりURIパラメータと同じIDを持つGoodsの情報を取得
        $goods = Goods::findOrFail($id);

        // 商品画像名を生成
        $goods_img_name = 'goods' . $goods->goods_id . '.jpg';

        // トランザクション処理
        DB::transaction(function () use ($goods, $request, $user_id, $goods_img_name) {

            $goods->goods_name = $request->goods_name;
            $goods->goods_description = $request->goods_description;
            $goods->category = $request->category;
            $goods->introducer = $user_id;
            $goods->goods_url = $request->goods_url;
            $goods->save();

            // 商品画像が送信された場合
            if (!empty($request->goods_img)) {

                // 画像をストレージに上書き保存
                $request->goods_img->storeAs('public/goods_img', $goods_img_name);
            }

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', '商品情報の更新が完了しました。');

        });

        return redirect("/mypage/" . $id . "/edit");
    }

    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);

        // トランザクション処理
        DB::transaction(function () use ($goods) {

            $goods->delete();

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', '商品の削除が完了しました。');

        });

        return redirect("/mypage");
    }
}
