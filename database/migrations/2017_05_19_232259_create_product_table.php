<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('product_type_id')->nullable()->comment('product_type.id, 포린.제품타입');
            $table->integer('manufacture_id')->nullable()->comment('manufacture.id, 포린.제조사');
            $table->string('product_code')->unique()->comment('제품코드. 제품 특정할수 있는값');
            $table->string('name')->comment('제품명 제품케이스에 써있고 화면표시할이름');
            $table->string('size')->nullable()->comment('규격 케이스에 쓰인값, 가로세로두께등');
            $table->string('quantity')->nullable()->comment('용량');
            $table->string('relate')->nullable()->comment('코드변형있을경우 신.구형코드 참조할수 있게써둔다');
            $table->integer('stock')->nullable()->comment('재고량');
            $table->integer('hold')->nullable()->comment('재고량중 발송하려고 뺴둔수량');
            $table->timestamp('last_stock_check')->nullable()->comment('마지막으로 재고확인한때');
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
        Schema::dropIfExists('product');
    }
}
