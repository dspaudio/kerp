<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProgressCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_progress_code', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('sales_progress_code')->comment('주문진행상황코드, 진행순서따라 숫자가 커지게.');
            $table->string('sales_progress_name')->comment('주문진행상황이름');
            $table->string('memo')->nullable()->comment('특이사항');
            $table->softDeletes();
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
        Schema::dropIfExists('sales_progress_code');
    }
}
