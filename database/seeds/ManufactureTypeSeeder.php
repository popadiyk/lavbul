<?php

use Illuminate\Database\Seeder;

class ManufactureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacture_types')->insert([
            'title' => 'realization',
        ]);

        DB::table('manufacture_types')->insert([
            'title' => 'fact',
        ]);
    }
}


