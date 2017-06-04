<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Delivery;


class DeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::firstOrCreate([
            'title' => 'Магазин',
            'price' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Delivery::firstOrCreate([
            'title' => 'УкрПочта',
            'price' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Delivery::firstOrCreate([
            'title' => 'Нова Почта',
            'price' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Delivery::firstOrCreate([
            'title' => 'Кур\'єр',
            'price' => 20,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
