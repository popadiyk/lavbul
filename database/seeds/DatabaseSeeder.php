<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(VoyagerDatabaseSeeder::class);*/
       /* $this->call(ManufactureTypeSeeder::class);*/
        $this->call(ManufactureTableSeeder::class);
        $this->call(ProductGroupsSeeder::class);
        $this->call(ProductsSeeder::class);
    }
}
