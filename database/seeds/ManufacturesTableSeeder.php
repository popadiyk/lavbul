<?php

use Illuminate\Database\Seeder;

class ManufacturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufactures')->insert([
            'title' => 'Roshen',
            'type_id' => 1,
            'phone' => '+380970000001',
            'email' => 'petro@gmail.com',
            'web_site' => 'prezedent.com',
            'ederpou' => '1234567890',
            'description' => 'Виставляє шоколадки на продає!',
        ]);
    }
}
