<?php

use Illuminate\Database\Seeder;
use App\OrderStatus;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::firstOrCreate([
            'title' => 'unconfirmed'
        ]);

        OrderStatus::firstOrCreate([
            'title' => 'confirmed'
        ]);

        OrderStatus::firstOrCreate([
            'title' => 'delivered'
        ]);

        OrderStatus::firstOrCreate([
            'title' => 'failed'
        ]);

        OrderStatus::firstOrCreate([
            'title' => 'closed'
        ]);
    }
}
