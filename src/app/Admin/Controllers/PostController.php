<?php

namespace App\Admin\Controllers;

use App\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Category;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post);

        $grid->column('post_id', __('ID'))->sortable();
        $grid->column('goods_name', __('商品名'));
        $grid->category()->category_name('カテゴリー');
        $grid->user()->user_name('紹介者');
        $grid->column('goods_img_src', __('商品画像'))->image();
        $grid->column('like_count', __('いいね数'))->sortable();
        $grid->column('created_at', __('作成日'))->sortable();
        $grid->column('updated_at', __('更新日'))->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('post_id', __('ID'));
        $show->field('goods_name', __('商品名'));
        $show->field('goods_description', __('商品説明'));
        $show->field('category', __('カテゴリー'))->as(function ($category) {
            return $category->category_name;
        });
        $show->field('user', __('紹介者'))->as(function ($user) {
            return $user->user_name;
        });
        $show->field('goods_url', __('商品URL'));
        $show->field('affiliate_url', __('アフィリエイトURL'));
        $show->field('goods_img_src', __('商品画像'))->image();
        $show->field('like_count', __('いいね数'));
        $show->field('created_at', __('作成日'));
        $show->field('updated_at', __('更新日'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $categories = Category::pluck('category_name', 'category_id');
        
        $post_id = preg_replace('/[^0-9]/', "", request()->path());
        $goods_img_name = 'goods' . $post_id . '.png';

        $form = new Form(new Post);

        $form->text('goods_name', __('商品名'));
        $form->textarea('goods_description', __('商品紹介文'));
        $form->select('category_id', __('カテゴリー'))->options($categories);
        $form->textarea('goods_url', __('商品URL'));
        $form->textarea('affiliate_url', __('アフィリエイトURL'));
        $form->image('goods_img_src', __('商品画像'))->move('/goods_img', $goods_img_name);

        return $form;
    }
}
