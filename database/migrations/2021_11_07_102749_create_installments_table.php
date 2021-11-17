<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('customer_id');
            $table->bigInteger('item_id');
            $table->bigInteger('balance');
            $table->bigInteger('quantity');
            $table->bigInteger('purchasing_price');
            $table->bigInteger('installment_selling_price');
            $table->bigInteger('number_months');
            $table->bigInteger('advance_purchase');
            $table->integer('premiums_paid')->default(0);
            $table->bigInteger('interest_value');
            $table->bigInteger('remaining_installments');
            $table->bigInteger('monthly_installment');
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
        Schema::dropIfExists('installments');
    }
}
