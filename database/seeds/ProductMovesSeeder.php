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
        	'product_id' => '2',
            'invoice_id' => '1',
            'quantity' => '1',
            'sum' => '12000',
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('product_moves')->insert([
            'product_id' => '2',
            'invoice_id' => '2',
            'quantity' => '1',
            'sum' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('product_moves')->insert([
            'product_id' => '1',
            'invoice_id' => '3',
            'quantity' => '1',
            'sum' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('product_moves')->insert([
            'product_id' => '3',
            'invoice_id' => '4',
            'quantity' => '1',
            'sum' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('product_moves')->insert([
            'product_id' => '2',
            'invoice_id' => '5',
            'quantity' => '1',
            'sum' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('product_moves')->insert([
            'product_id' => '3',
            'invoice_id' => '6',
            'quantity' => '1',
            'sum' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
