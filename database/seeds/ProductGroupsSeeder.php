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
            'title' => 'Вироби ручної роботи',
            'group_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Товари для рукоділля',
            'group_id' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Іграшки',
            'group_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Картини',
            'group_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Фанера',
            'group_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Лазерні нічники',
            'group_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Папір в наборах',
            'group_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Папір по-штучно',
            'group_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('groups')->insert([
            'title' => 'Клейові матеріали',
            'group_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}

