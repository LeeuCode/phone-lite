<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('barcode');
            $table->bigInteger('user_id')->nullable();
            $table->string('title');
            $table->integer('cat_id');
            $table->integer('unit_id');
            $table->integer('model')->nullable();
            $table->string('warranty_period')->nullable();
            $table->integer('purchasing_price');
            $table->integer('selling_price')->default(0);
            $table->integer('average_price')->default(0);
            $table->integer('store_balance')->default(0);
            $table->string('expiration_date')->nullable();
            $table->integer('publish')->default(1);
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
        Schema::dropIfExists('items');
    }
}
