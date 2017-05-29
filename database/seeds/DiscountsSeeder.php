<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            'total_orders_sum' => '1000',
            'card' => '123456789',
            'percent_id' => '1',
            'description' => 'Дуже вучливий клієнт',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
