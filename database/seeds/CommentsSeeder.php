<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'text' => 'дуже класний товар, мені все сподобалось!',
            'name' => 'Бобер',
            'email' => 'bober@gmail.com',
            'user_id' => '1',
            'product_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
