<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdererTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderer', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('customer_id')->comment('포린.고객테이블의 아이디. 주소를 가지는 고객특정하기');
            $table->string('orderer_name')->comment('주문자이름');
            $table->string('orderer_name_jp')->nullable()->comment('주문자이름 일어');
            $table->string('orderer_email')->nullable()->comment('주문자 이멜');
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
        Schema::dropIfExists('orderer');
    }
}
