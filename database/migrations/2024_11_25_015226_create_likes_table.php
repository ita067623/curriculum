<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id'); // ID
            $table->foreignId('article_id')->constrained()->onDelete('cascade'); // articlesテーブルの外部キー
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // usersテーブルの外部キー
            $table->timestamps(); // 登録日時、更新日時
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
    }
}
