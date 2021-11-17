<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_months', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('installment_id');
            $table->bigInteger('monthly_installment');
            $table->integer('state')->default(0);
            $table->string('renewal_date');
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
        Schema::dropIfExists('installment_months');
    }
}
