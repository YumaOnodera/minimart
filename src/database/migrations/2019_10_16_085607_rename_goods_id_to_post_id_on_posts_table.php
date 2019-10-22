<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameGoodsIdToPostIdOnPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints(); //外部キー制約を一時的に無効化
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('goods_id', 'post_id');
        });
        Schema::enableForeignKeyConstraints(); //外部キー制約を有効化
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints(); //外部キー制約を一時的に無効化
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('post_id', 'goods_id');
        });
        Schema::enableForeignKeyConstraints(); //外部キー制約を有効化
    }
}
