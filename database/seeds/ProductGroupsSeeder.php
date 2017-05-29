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
    }
}

