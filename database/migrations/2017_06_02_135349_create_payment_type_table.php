<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTypeTable extends Migration
{
    /**
     * Run the migrations.
     * @GOTO delete row of dropping pay_types
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pay_types');

        Schema::create('payment_types', function(Blueprint $table) {
           $table->increments('id');
           $table->string('title')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_types');
    }
}
