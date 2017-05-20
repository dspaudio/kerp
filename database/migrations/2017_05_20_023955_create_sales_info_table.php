<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_info', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->string('sales_code')->unique->comment('매출코드, ');
            $table->integer('sales_progress_code')->comment('포린.매출상황코드, ');
            $table->string('sales_staff_code')->comment('포린.영업담당직원');
            $table->timestamp('sales_made')->comment('주문일');
            $table->integer('customer_id')->comment('포린.고객아이디');
            $table->integer('orderer_id')->comment('포린.주문자아이디');
            $table->string('product_code')->comment('포린.주문제품.제품코드');
            $table->integer('sales_quantity')->comment('주문수량');
            $table->integer('unit_price')->comment('단가');
            $table->integer('charged')->comment('청구액.*+1행사등으로 수량*단가가 안맞을수 있음 그래서 청구가 따로넣음');
            $table->string('event_memo')->comment('이벤트 내용 쓰기. +1행사등 덤주거나 할인해주거한내용 적기');
            $table->timestamp('payment_date')->comment('결제일');
            $table->timestamp('ship_out_complete_date')->comment('발송완료일');
            $table->string('payment_type_code')->comment('포린.결제방법코드');
            $table->string('order_type_code')->comment('포린.주문방법코드');
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
        Schema::dropIfExists('sales_info');
    }
}
