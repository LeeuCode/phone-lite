<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsedDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('agent_name');
            $table->string('agent_phone')->nullable();
            $table->integer('Device_type');
            $table->integer('model')->nullable();
            $table->string('imei')->nullable();
            $table->integer('purchase_price');
            $table->integer('sale_price');
            $table->integer('state');
            $table->text('receipt_notes');
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
        Schema::dropIfExists('used_devices');
    }
}
