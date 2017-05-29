<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function(Blueprint $table) {
           $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('title')->unique();
            $table->integer('purchase_price')->default(0);
            $table->integer('price')->default(0);
            $table->integer('manufacture_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->integer('marking')->unique();
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
        Schema::dropIfExists('deliveries');
    }
}
