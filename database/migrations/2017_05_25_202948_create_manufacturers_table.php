<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('manufactures', function(Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->integer('type_id')->unsigned()->default('1');
          $table->string('phone', 13)->default('+380970000000');
          $table->string('email')->nullable();
          $table->string('web_site')->nullable();
          $table->string('inn')->nullable();
          $table->string('ederpou', 10)->nullable();
          $table->string('mfo')->nullable();
          $table->string('rr')->nullable();
          $table->string('bank')->nullable();
          $table->text('description')->nullable();
          $table->integer('account_debt')->nullable();
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
        Schema::dropIfExists('manufactures');
    }
}






