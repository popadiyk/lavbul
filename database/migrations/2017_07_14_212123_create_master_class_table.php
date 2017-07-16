<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_class', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('master');
            $table->string('technology');
            $table->integer('max_seats')->default(6);
            $table->integer('full_seets')->default(0);
            $table->integer('max_age')->default(12);
            $table->integer('duration');
            $table->float('price');
            $table->string('main_photo');
            $table->string('place');
            $table->dateTime('date_time');
            $table->string('status');
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
        Schema::dropIfExists('master_class');
    }

}
