<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('goods_id');
            $table->string('goods_name', 50);
            $table->string('goods_description', 1000);
            $table->integer('category');
            $table->integer('introducer');
            $table->string('goods_url', 1000);
            $table->string('affiliate_url', 1000)->nullable();
            $table->string('goods_img_src', 1000);
            $table->integer('like_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
