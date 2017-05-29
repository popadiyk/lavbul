<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductMovesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('product_moves')->insert([
        	'product_id' => '1',
            'invoice_id' => '1',
            'quantity' => '10',
            'sum' => '1000',
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
