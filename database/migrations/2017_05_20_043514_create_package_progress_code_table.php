<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageProgressCodeTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * 패키징 진행상황
     * 패키징 대기중
     * 패키징 작업중
     * 발송가능
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_progress_code', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->integer('package_progress_code')->unique()->comment('패키징진행상황코드, 진행순서따라 숫자가 커지게.');
            $table->string('package_progress_name')->comment('패키징진행상황이름');
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
        Schema::dropIfExists('package_progress_code');
    }
}
