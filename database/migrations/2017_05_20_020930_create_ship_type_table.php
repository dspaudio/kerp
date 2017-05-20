<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_type', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->string('ship_type_code')->unique()->comment('발송방법code');
            $table->string('ship_type_name')->comment('발송방법이름');
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
        Schema::dropIfExists('ship_type');
    }
}
