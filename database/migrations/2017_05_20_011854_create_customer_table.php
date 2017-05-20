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
            $table->string('customer_name_jp')->nullable()->comment('일본어이름');
            $table->integer('defalt_staff_code')->nullable()->comment('포린.담당직원 있으면 쓰기');
            $table->integer('defalt_order_type_code')->nullable()->comment('포린.기본 주문방식 있으면 넣기');
            $table->integer('defalt_payment_type_code')->nullable()->comment('포린.기본 결제방식 있으면 넣기');
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
