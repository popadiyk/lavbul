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
        $this->call(PayStatusesSeeder::class);
        $this->call(InvoiceTypesSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(PercentsSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(ProductMovesSeeder::class);
        $this->call(DeliveriesSeeder::class);
        $this->call(PayTypesSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(InvoicesSeeder::class);

    }
}
