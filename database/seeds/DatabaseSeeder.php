<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VoyagerDatabaseSeeder::class);
        $this->call(ManufactureTypeSeeder::class);
        $this->call(ManufactureTableSeeder::class);
        $this->call(ProductGroupsSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(ProductsSeeder::class);
//        $this->call(InvoiceTypesSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(PercentsSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(ProductMovesSeeder::class);
        $this->call(DeliveriesSeeder::class);
        $this->call(InvoicesSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(MasterClassSeeder::class);
        $this->call(MainProductSeeder::class);
        $this->call(NewsSeeder::class);
        // $this->call(PaymentSeeder::class);
//        $this->call(AdminAboutUsSeeder::class);
//        $this->call(AdminGroupsSeeder::class);
    }
}
