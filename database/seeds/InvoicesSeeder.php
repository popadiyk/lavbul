<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            'type' => 'sales',
            'client_id' => '1',
            'author_id' => '1',
            'status' => 'unconfirmed',
            'total_account' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('invoices')->insert([
            'type' => 'realisation',
            'client_id' => '1',
            'author_id' => '1',
            'status' => 'failed',
            'total_account' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('invoices')->insert([
            'type' => 'purchase',
            'client_id' => '1',
            'author_id' => '1',
            'status' => 'closed',
            'total_account' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('invoices')->insert([
            'type' => 'sales',
            'client_id' => '1',
            'author_id' => '1',
            'status' => 'confirmed',
            'total_account' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('invoices')->insert([
            'type' => 'writeOf',
            'client_id' => '1',
            'author_id' => '1',
            'status' => 'confirmed',
            'total_account' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('invoices')->insert([
            'type' => 'sales',
            'client_id' => '1',
            'author_id' => '1',
            'status' => 'confirmed',
            'total_account' => '12000',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
