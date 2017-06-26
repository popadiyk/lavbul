<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10000; $i++){
            DB::table('products')->insert([
                'group_id' => 3,
                'title' => 'Заєць маленький'.$i,
                'purchase_price' => 10000,
                'price' => 12000,
                'manufacture_id' => 1,
                'quantity' => 10,
                'description' => 'Чудові зайці, як для подарунку, так і для себе!',
                'marking' => 40000+$i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'main_photo' => '/products_photo/30000.jpg'
            ]);

        }


    }
}