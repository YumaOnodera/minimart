<?php

namespace App\Admin\Controllers;

use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->column('category_id', __('ID'))->sortable();
        $grid->column('category_name', __('カテゴリー名'));
        $grid->column('category_description', __('カテゴリー説明'));
        $grid->column('category_slug', __('スラッグ'));
        $grid->column('category_img_src', __('カテゴリー画像'))->image();
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
        $show = new Show(Category::findOrFail($id));

        $show->field('category_id', __('ID'));
        $show->field('category_name', __('カテゴリー名'));
        $show->field('category_description', __('カテゴリー説明'));
        $show->field('category_slug', __('スラッグ'));
        $show->field('category_img_src', __('カテゴリー画像'))->image();
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
        $form = new Form(new Category);

        $form->text('category_name', __('カテゴリー名'));
        $form->text('category_description', __('カテゴリー説明'));
        $form->text('category_slug', __('スラッグ'));
        $form->image('category_img_src', __('カテゴリー画像'))->move('/categories_img');

        return $form;
    }
}
