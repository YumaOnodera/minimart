<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('likes');
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('liked_user')->unsigned();
            $table->bigInteger('liked_post')->unsigned();
            $table->timestamps();

            $table->foreign('liked_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // userが削除されたとき、それに関連するlikeも一気に削除される

            $table->foreign('liked_post')
                  ->references('post_id')
                  ->on('posts')
                  ->onDelete('cascade'); // postsが削除されたとき、それに関連するlikeも一気に削除される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('liked_user')->unsigned();
            $table->bigInteger('liked_goods')->unsigned();
            $table->timestamps();

            $table->foreign('liked_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // userが削除されたとき、それに関連するlikeも一気に削除される

            $table->foreign('liked_goods')
                  ->references('goods_id')
                  ->on('goods')
                  ->onDelete('cascade'); // goodsが削除されたとき、それに関連するlikeも一気に削除される
        });
    }
}
