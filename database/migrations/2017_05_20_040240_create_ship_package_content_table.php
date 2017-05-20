<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipPackageContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_package_content', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('package_code')->unique()->comment('패키지코드. 특정할수 있게');
            $table->integer('package_progress_code')->comment('패키징 진행상황');
            $table->integer('sales_id')->comment('포린.발송나간 제품의 매출정보. 특정할수 있게');
            $table->integer('package_quantity')->comment('발송수량. 주문받은 수량중 해당 발송 정보로 발송하는 수량');
            $table->string('package_staff_code')->comment('포린.패키징담당 직원 code');
            $table->string('content_pic')->nullable()->comment('배송나간 물건들의 사진파일명');
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
        Schema::dropIfExists('ship_package_content');
    }
}
