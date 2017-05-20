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
            $table->integer('package_code')->comment('포린.발송나간 제품의 매출정보. 특정할수 있게');
            $table->integer('ship_type_id')->comment('포린.발송 타입');
            $table->integer('ship_progress_code')->comment('포린.발송진행상황코드');
            $table->integer('address_id')->comment('포린.발송하는 주소의 아이디. 특정할수 있게');
            $table->string('ship_staff_code')->comment('포린.발송담당 직원 code');
            $table->timestamp('ship_out_date')->nullable()->comment('발송나간날짜');
            $table->timestamp('ship_received_date')->nullable()->comment('제품도착날짜');
            $table->string('ship_invoce_code')->nullable()->comment('포린.송장번호');
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
