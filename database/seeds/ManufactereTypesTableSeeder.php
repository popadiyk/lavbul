<?php

use Illuminate\Database\Seeder;

class ManufactereTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacture_types')->insert([
            'title' => 'owner',
        ]);

        DB::table('manufacture_types')->insert([
            'title' => 'realisator',
        ]);
    }
}
