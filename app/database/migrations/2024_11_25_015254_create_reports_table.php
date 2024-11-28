<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id'); // ID
            $table->unsignedBigInteger('user_id'); // 投稿者のID
            $table->unsignedBigInteger('post_id'); // 案件のID
            $table->string('reason', 225); // 報告理由
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
        Schema::dropIfExists('reports');
    }
}
