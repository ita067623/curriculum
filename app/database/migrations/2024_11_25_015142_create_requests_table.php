<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id'); // ID
            $table->unsignedBigInteger('post_id'); // 案件のID
            $table->unsignedBigInteger('user_id'); // 依頼者のID
            $table->text('content'); // 依頼内容
            $table->string('phone_number', 20)->nullable(); // 依頼者の電話番号
            $table->string('email', 100); // 依頼者のメールアドレス
            $table->date('date')->nullable(); // 希望納期
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
        Schema::dropIfExists('requests');
    }
}
