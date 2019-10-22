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
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['liked_goods']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('goods_id', 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('post_id', 'goods_id');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('liked_goods')
                  ->references('goods_id')
                  ->on('goods')
                  ->onDelete('cascade');
        });
    }
}
