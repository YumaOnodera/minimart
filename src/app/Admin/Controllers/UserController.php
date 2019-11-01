<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('user_id', __('ユーザーID'));
        $grid->column('user_name', __('ユーザー名'));
        $grid->column('site_url', __('サイトURL'));
        $grid->column('email', __('メールアドレス'));
        $grid->column('created_at', __('作成日'))->sortable();
        $grid->column('updated_at', __('更新日'))->sortable();
        $grid->column('deleted_at', __('削除日'))->sortable();

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('user_id', __('ユーザーID'));
        $show->field('user_name', __('ユーザー名'));
        $show->field('introduction', __('紹介文'));
        $show->field('avatar_img_src', __('アバター画像'))->image();
        $show->field('header_img_src', __('ヘッダー画像'))->image();
        $show->field('site_url', __('サイトURL'));
        $show->field('email', __('メールアドレス'));
        $show->field('created_at', __('作成日'));
        $show->field('updated_at', __('更新日'));
        $show->field('deleted_at', __('削除日'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('user_id', __('ユーザーID'));
        $form->text('user_name', __('ユーザー名'));
        $form->textarea('introduction', __('紹介文'));
        $form->image('avatar_img_src', __('アバター画像'))->move('/avatar_img');
        $form->image('header_img_src', __('ヘッダー画像'))->move('/header_img');
        $form->text('site_url', __('サイトURL'));
        $form->email('email', __('メールアドレス'));

        return $form;
    }
}
