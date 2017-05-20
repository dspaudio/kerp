<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->string('customer_name')->comment('사람, 병원 매출기준되는 정보');
            $table->string('director_name')->nullable()->comment('원장이름');
            $table->string('director_name_jp')->nullable()->comment('원장일본어');
            $table->string('clinic_name')->nullable()->comment('병원이름');
            $table->string('clinic_name_jp')->nullable()->comment('병원이름일본어');
            $table->integer('staff_id')->nullable()->comment('포린.담당직원 있으면 쓰기');
            $table->integer('default_order_type_code')->nullable()->comment('기본 주문방식 있으면 넣기');
            $table->integer('default_payment_type_code')->nullable()->comment('기본 결제방식 있으면 넣기');
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
        Schema::dropIfExists('customer');
    }
}
