<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'valet',
            'email' => 'valet@gmail.com',
            'phone' => '+380977005020',
            'role_id' => 1,
            'password' => bcrypt('qwerty'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '+380977000000',
            'role_id' => 2,
            'password' => bcrypt('qwerty'),
        ]);
    }
}
