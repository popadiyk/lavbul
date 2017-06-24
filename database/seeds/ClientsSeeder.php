<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => 'Кінцевий споживач',
            'card' => 0,
            'phone' => '',
            'email' => '',
            'discount' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clients')->insert([
            'name' => 'Попадюк Олена',
            'card' => 1,
            'phone' => '0676032401',
            'email' => 'elena-romashka@ukr.net',
            'discount' => 100,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('clients')->insert([
            'name' => 'Попадюк Aндрій',
            'card' => 999,
            'phone' => '0632290639',
            'email' => 'apopadiyk@gmail.com',
            'discount' => 10,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
