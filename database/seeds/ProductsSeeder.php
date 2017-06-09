<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'group_id' => 1,
            'title' => 'Натюрморд з помідорою',
            'purchase_price' => 10000,
            'price' => 12000,
            'manufacture_id' => 1,
            'quantity' => 10,
            'description' => 'написаний Вінницьким художником',
            'marking' => 10000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/10000.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 1,
            'title' => 'Жіноча натура',
            'purchase_price' => 10000,
            'price' => 12000,
            'manufacture_id' => 1,
            'quantity' => 10,
            'description' => 'написаний Вінницьким художником',
            'marking' => 10001,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/10001.jpg'
        ]);

    }
}