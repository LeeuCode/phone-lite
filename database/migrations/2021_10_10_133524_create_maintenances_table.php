<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('agent_name');
            $table->string('agent_phone')->nullable();
            $table->integer('Device_type');
            $table->integer('model')->nullable();
            $table->string('imei')->nullable();
            $table->string('malfunction');
            $table->text('customer_complaint')->nullable();
            $table->text('receipt_notes')->nullable();
            $table->string('delivery_date')->nullable();
            $table->integer('maintenance_status')->nullable();
            $table->string('device_recipient')->nullable();
            $table->string('delivery_time')->nullable();
            $table->integer('maintenance_cost')->default(0);
            $table->integer('spare_parts_value')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('residual')->default(0);
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
        Schema::dropIfExists('maintenances');
    }
}
