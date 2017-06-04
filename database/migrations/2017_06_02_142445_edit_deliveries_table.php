<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     * @GOTO It will be deleted
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('deliveries', 'updated_at')) {
            Schema::table('deliveries', function (Blueprint $table) {
                $table->dropColumn(['updated_at']);
            });
        }

        Schema::table('deliveries', function (Blueprint $table) {
            $table->integer('price')->nullable()->change();
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
