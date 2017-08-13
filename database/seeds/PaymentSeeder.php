<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'title' => 'На картку Приват Банку',
        ]);

    }
}
