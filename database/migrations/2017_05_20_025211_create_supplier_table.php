<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id')->comment('프라이머리키');
            $table->string('supplier_code')->unique()->comment('특정할수 있게');
            $table->string('supplier_name')->comment('특정할수 있게');
            $table->string('supplier_staff_name')->nullable()->comment('');
            $table->string('supplier_staff_contact')->nullable()->comment('');
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
        Schema::dropIfExists('supplier');
    }
}
