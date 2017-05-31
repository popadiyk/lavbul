<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     * @TODO delivery_id string and name is nullable
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table){
           $table->increments('id');
           $table->integer('user_id')->unsigned();
           $table->string('name')->nullable();
           $table->longText('cart');
           $table->string('payment_id')->nullable();
           $table->string('delivery_id');
           $table->string('address')->nullable();
           $table->integer('status_id')->unsigned()->default(1);
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
        Schema::dropIfExists('orders');
    }
}
