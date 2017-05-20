<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('customer_id')->comment('포린.고객테이블의 아이디. 주소를 가지는 고객특정하기');
            $table->string('addressee')->comment('수신인 이름');
            $table->string('addressee_jp')->nullable()->comment('수신인 이름 일어');
            $table->string('address')->comment('배송주소');
            $table->string('address_jp')->nullable()->comment('배송주소 일어');
            $table->string('zip_code')->nullable()->comment('우편번호');
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
        Schema::dropIfExists('address');
    }
}
