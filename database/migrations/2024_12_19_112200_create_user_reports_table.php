<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->increments('id'); // 主キー
            $table->unsignedBigInteger('user_id'); // 
            $table->unsignedBigInteger('reported_by');  
            $table->text('reason');  // 違反内容
            $table->enum('status', ['pending', 'resolved', 'rejected'])->default('pending');  // 報告の状態
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
        Schema::dropIfExists('user_reports');
    }
}
