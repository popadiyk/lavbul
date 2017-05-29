<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'name' => 'Бобёр',
            'secondname' => 'Бобров',
            'delivery_address' => 'улица Блабла, дом. 3',
            'delivery_id' => '1',
            'pay_type_id' => '1',
            'total_sum' => '100',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
