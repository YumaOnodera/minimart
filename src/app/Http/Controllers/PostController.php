<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{

    public function index($id = null)
    {
        // Postsテーブルの値を取得
        $posts = Post::join('users','posts.introducer','=','users.id')
            ->join('categories','posts.category_id','=','categories.category_id')
            ->whereNull('users.deleted_at')
            ->when($id, function ($query) use ($id) {
                return $query->where('users.user_id', $id);
            })
            ->orderBy('posts.like_count', 'desc')
            ->orderBy('posts.created_at', 'desc')
            ->get();

        // Userテーブルの値を取得
        $user = User::where('users.user_id', $id)
            ->first();

        return view('post/index', compact('posts', 'user'));
    }

    public function show($id)
    {
        // DBよりURIパラメータと同じIDを持つPostsの情報を取得
        $post = Post::join('users','posts.introducer','=','users.id')
            ->join('categories','posts.category_id','=','categories.category_id')
            ->whereNull('users.deleted_at')
            ->findOrFail($id);

        return view('post/show', compact('post'));
    }

    public function create()
    {
        $post = new Post();

        $categories = Category::select(
            'categories.category_id',
            'categories.category_name'
            )
            ->get();

        return view('post/create', compact('post', 'categories'));
    }

    public function store(PostStoreRequest $request)
    {
        // アップロードに成功しているか確認
        if(!empty($request->file('goods_img'))) {

            $id = Auth::id();
            $user_id = Auth::user()->user_id;

            // 商品画像名生成用にpost_idの最大値を取得
            $max_post_id = Post::select(
                'posts.post_id'
                )
                ->max('post_id');

            // 商品画像名を生成
            $new_post_id = $max_post_id + 1;
            $goods_img_name = 'goods' . $new_post_id . '.png';

            // トランザクション処理
            DB::transaction(function () use ($request, $id, $goods_img_name) {

                $post = new Post();
                $post->goods_name = $request->goods_name;
                $post->goods_description = $request->goods_description;
                $post->category_id = $request->category;
                $post->introducer = $id;
                $post->goods_url = $request->goods_url;
                $post->goods_img_src = 'goods_img/' . $goods_img_name;
                $post->save();

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

        return redirect("/" . $user_id);
    }

    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つPostの情報を取得
        $post = Post::join('categories','posts.category_id','=','categories.category_id')
            ->findOrFail($id);

        $categories = Category::select(
            'categories.category_id',
            'categories.category_name'
            )
            ->get();

        return view('post/edit', compact('post', 'categories'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $user_id = Auth::id();
        $post_id = $post->post_id;

        // 商品画像名を生成
        $goods_img_name = 'goods' . $post->post_id . '.png';

        // トランザクション処理
        DB::transaction(function () use ($post, $request, $user_id, $goods_img_name) {

            $post->goods_name = $request->goods_name;
            $post->goods_description = $request->goods_description;
            $post->category_id = $request->category;
            $post->introducer = $user_id;
            $post->goods_url = $request->goods_url;
            $post->goods_img_src = 'goods_img/' . $goods_img_name;
            $post->save();

            // 商品画像が送信された場合
            if (!empty($request->goods_img)) {

                // 画像をストレージに上書き保存
                $request->goods_img->storeAs('public/goods_img', $goods_img_name);
            }

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', '商品情報の更新が完了しました。');

        });

        return redirect("/post/" . $post_id . "/edit");
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $user_id = Auth::user()->user_id;

        // トランザクション処理
        DB::transaction(function () use ($post) {

            $post->delete();

            // セッションに成功メッセージを渡す
            session()->flash('flash_message', '商品の削除が完了しました。');

        });

        return redirect("/" . $user_id);
    }
}
