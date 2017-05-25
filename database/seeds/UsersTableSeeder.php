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
            'password' => bcrypt('qwerty'),
        ]);
    }
}
