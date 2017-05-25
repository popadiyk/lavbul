<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'title' => 'user',
        ]);

        DB::table('roles')->insert([
            'title' => 'admin',
        ]);

        DB::table('roles')->insert([
            'title' => 'accountant',
        ]);

        DB::table('roles')->insert([
            'title' => 'cashier',
        ]);

        DB::table('roles')->insert([
            'title' => 'super_user'
        ]);
    }
}