<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aboutuses')->insert([
            'name' => 'Лавка-Булавка',
            'min_logo' => '/img/min_logo.png',
            'max_log' => '/img/max_logo.png',
            'description' => 'Відкрились у 2017 р.',
            'full_description' => 'Гарно гуляли!',
            'contact_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
   }
}