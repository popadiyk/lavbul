<?php

use Illuminate\Database\Seeder;
use App\PaymentType;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::firstOrCreate([
            'title' => 'Безготівковий'
        ])->save();

        PaymentType::firstOrCreate([
            'title' => 'Готівковий'
        ])->save();
    }
}
