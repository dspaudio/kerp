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
            $table->integer('sales_progress_code')->comment('포린.매출상황코드, ');
            $table->integer('staff_id')->comment('포린.영업담당직원');
            $table->timestamp('sales_made')->comment('주문일');
            $table->integer('customer_id')->comment('포린.고객아이디');
            $table->integer('orderer_id')->comment('포린.주문자아이디');
            $table->integer('product_id')->comment('포린.주문제품.제품코드');

	        $table->string('product_code')->nullable()->comment('제품코드. 제품 특정할수 있는값');
	        $table->string('product_name')->nullable()->comment('제품명 제품케이스에 써있고 화면표시할이름');
	        $table->string('product_size')->nullable()->comment('규격 케이스에 쓰인값, 가로세로두께등');
	        $table->string('product_quantity')->nullable()->comment('용량');
	        $table->string('product_relate')->nullable()->comment('코드변형있을경우 신.구형코드 참조할수 있게써둔다');

            $table->integer('product_type_id')->nullable()->comment('product_type.id, 포린.제품타입');
	        $table->string('product_type_code')->nullable()->comment('코드');
	        $table->string('product_type_name')->nullable()->comment('이름');

	        $table->integer('manufacture_id')->nullable()->comment('manufacture.id, 포린.제조사');
	        $table->string('manufacture_name')->nullable()->comment('이름');
	        $table->string('manufacture_code')->nullable()->comment('code');

            $table->integer('sales_quantity')->comment('주문수량');
            $table->integer('unit_price')->comment('단가');
            $table->integer('charged')->comment('청구액.*+1행사등으로 수량*단가가 안맞을수 있음 그래서 청구가 따로넣음');
            $table->string('event_memo')->nullable()->comment('이벤트 내용 쓰기. +1행사등 덤주거나 할인해주거한내용 적기');
            $table->timestamp('payment_date')->nullable()->comment('결제일');
            $table->timestamp('ship_out_complete_date')->nullable()->comment('발송완료일');
            $table->string('payment_type_code')->nullable()->comment('결제방법코드');
            $table->integer('order_type_code')->comment('주문방법코드');
            $table->timestamp('sales_cancel_date')->nullable()->comment('주문취소일');
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
