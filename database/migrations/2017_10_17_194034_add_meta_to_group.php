<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaToGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('meta_title')->default('Купити hand-made подарунки в Україні! Купить hand-made товары в Украине! на bulavka.org');
            $table->string('meta_keyword')->default('декупаж ! подарки Украина ! скрапбукинг ! кукла-тильда ! скрап ! валяння ! валяние ! фоамиран ! фом ! бисер');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
