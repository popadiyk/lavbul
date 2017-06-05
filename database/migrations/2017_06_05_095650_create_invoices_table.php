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
        Schema::dropIfExists('invoices');

        Schema::create('invoices', function(Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['purchase', 'sales', 'writeOf', 'realisation'])->default('sales');
            $table->integer('client_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->enum('status', ['unconfirmed', 'confirmed', 'closed', 'failed'])->default('unconfirmed');
            $table->integer('total_account')->nullable();
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
