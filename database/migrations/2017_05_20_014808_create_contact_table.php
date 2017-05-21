<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('address_id')->comment('포린.당 연락처가 속하는 주소 특정가능하게');
            $table->integer('contact_type')->nullable()->default(0)->comment('연락처종류 전화 팩스 등등');
            $table->string('contact_num')->comment('연락처');
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
        Schema::dropIfExists('contact');
    }
}
