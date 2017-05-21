<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_info', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('ship_type_code')->comment('발송 타입');
            $table->integer('ship_progress_code')->comment('발송진행상황코드');
	        $table->string('contact')->comment('수신인 연락처');
	        $table->string('addressee')->comment('수신인 이름');
	        $table->string('address')->comment('배송주소');
	        $table->string('zip_code')->comment('우편번호');
	        $table->string('contents')->comment('제품명/수량/가격 실제 정보 아니라 세관통과가능한 정보');
	        //주소테이블은 송장입력시 참조, 실제 송장은 맘대로 편집가능
	        //즉 주소 아이디 아닌 진짜 입력된 송장정보를 직접 갖고 있어야함
            //$table->integer('address_id')->comment('포린.발송하는 주소의 아이디. 특정할수 있게');
            $table->integer('staff_id')->comment('포린.발송담당 직원 code');
            $table->timestamp('ship_out_date')->nullable()->comment('발송나간날짜');
            $table->timestamp('ship_received_date')->nullable()->comment('제품도착날짜');
	        $table->string('ship_pic')->nullable()->comment('배송나간 물건들의 사진파일명');
            $table->string('ship_invoice_code')->nullable()->comment('포린.송장번호');
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
        Schema::dropIfExists('ship_info');
    }
}
