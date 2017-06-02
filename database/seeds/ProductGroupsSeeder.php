<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'title' => 'Картини',
            'group_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Деревяні вироби',
            'group_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Іграшки',
            'group_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Товари для рукоділля',
            'group_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Рамки',
            'group_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Деревяні ложки',
            'group_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Зайці',
            'group_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Великі зайці',
            'group_id' => '7',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Деревяні ноги',
            'group_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}

