<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // id: Primary Key, Auto Increment
            $table->string('name', 50); // ユーザー名
            $table->string('email', 50)->unique(); // メールアドレス（ユニーク制約）
            $table->string('password', 255); // パスワード（ハッシュ化）
            $table->string('reset_token', 255)->nullable(); // パスワードリセット用トークン
            $table->dateTime('token_expiration')->nullable(); // トークンの有効期限
            $table->string('image', 255)->nullable(); // ユーザーアイコン
            $table->string('profile', 300)->nullable(); // プロフィール
            $table->integer('role')->default(2); // ユーザー区分（デフォルト値2:一般ユーザー）
            $table->boolean('del_flg')->default(false); // 論理削除フラグ（デフォルト値:0/false）
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
