<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            'autor_id' => '1',
            'user_id'=> '1',
            'manufacturer_id' => '1',
            //'pay_status_id' => '1',
            'type_id' => '1',
            'description' => 'накладна на надходження',
            'total_sum' => '1000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
