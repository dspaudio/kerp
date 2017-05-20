<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_in_info', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('sales_info_id')->nullable()->comment('포린.발주넣게된 매출정보. 특정할수 있게');
            $table->integer('order_in_progress_code')->comment('포린.발주진행상황코드');
            $table->integer('supplier_id')->comment('포린.발주처 코드. 특정할수 있게');
            $table->integer('order_in_quantity')->comment('주문수량');
            $table->integer('staff_id')->comment('포린.발주 넣은 직원 id');
            $table->timestamp('order_in_made')->nullable()->comment('발주넣은날짜');
            $table->timestamp('order_in_expect')->nullable()->comment('발주제품 도착예정일');
            $table->timestamp('order_in_received')->nullable()->comment('발주제품 도착일');
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
        Schema::dropIfExists('order_in_info');
    }
}
