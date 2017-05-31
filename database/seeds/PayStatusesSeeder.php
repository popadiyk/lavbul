<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PayStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pay_statuses')->insert([
            'status' => 'оплачено',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
