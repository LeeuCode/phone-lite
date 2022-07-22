<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('invoice_type');
            $table->string('movement_type');
            $table->integer('total');
            $table->integer('discount_amount');
            $table->integer('discount_percentage');
            $table->integer('total_discount');
            $table->integer('tax_rate')->default(0);
            $table->integer('tax_value')->default(0);
            $table->integer('total_tax')->default(0);
            $table->integer('total_bill');
            $table->integer('paid');
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
        Schema::dropIfExists('invoices');
    }
}
