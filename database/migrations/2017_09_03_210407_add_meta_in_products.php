<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('meta_title')->default('Купити hand-made подарунки в Україні! Купить hand-made товары в Украине! на bulavka.org');
            $table->string('meta_keyword')->default('Купити hand-made ! подарунки в Україні ! Купить товары для рукоделия ! Товари для рукоділля ! декупаж ! подарки Украина ! скрапбукинг ! кукла-тильда ! скрап ! валяння ! валяние ! фоамиран ! фом ! бисер');
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
