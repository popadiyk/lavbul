<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'group_id' => 3,
            'title' => 'Заєць маленький',
            'purchase_price' => 10000,
            'price' => 12000,
            'manufacture_id' => 1,
            'quantity' => 10,
            'description' => 'Чудові зайці, як для подарунку, так і для себе!',
            'marking' => 30000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30000.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 3,
            'title' => 'Жирафа',
            'purchase_price' => 10000,
            'price' => 12000,
            'manufacture_id' => 1,
            'quantity' => 10,
            'description' => 'Ідея створення жирафів-тільд прийшла до нам зовсім не давно, але вже користується шаленим попитом серед відвідувачів нашого магазину!',
            'marking' => 30001,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30001.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 3,
            'title' => 'Собака такса',
            'purchase_price' => 10000,
            'price' => 12000,
            'manufacture_id' => 1,
            'quantity' => 10,
            'description' => 'Собака-тільда була розроблена спеціально до року собаки за східним календарем!',
            'marking' => 30002,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30002.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 4,
            'title' => 'Репродукція картини "Хор"',
            'purchase_price' => 20000,
            'price' => 28000,
            'manufacture_id' => 1,
            'quantity' => 8,
            'description' => 'Репродукція картини автора Габчинської',
            'marking' => 30003,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30003.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 4,
            'title' => 'Репродукція картини "Мой пирожек"',
            'purchase_price' => 20000,
            'price' => 28000,
            'manufacture_id' => 1,
            'quantity' => 1,
            'description' => 'Репродукція картини автора Габчинської',
            'marking' => 30004,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30004.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 5,
            'title' => 'Коник',
            'purchase_price' => 900,
            'price' => 1500,
            'manufacture_id' => 1,
            'quantity' => 3,
            'description' => 'Лазерна вирізка забезпечить ідеальні контури виробу.',
            'marking' => 30005,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30005.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 5,
            'title' => 'Рамка Фемелі',
            'purchase_price' => 10000,
            'price' => 18000,
            'manufacture_id' => 1,
            'quantity' => 2,
            'description' => 'Лазерна вирізка забезпечить ідеальні контури виробу.',
            'marking' => 30006,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30006.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 6,
            'title' => 'Нічник з троякдою',
            'purchase_price' => 1200,
            'price' => 1900,
            'manufacture_id' => 1,
            'quantity' => 3,
            'description' => 'Лазерна вирізка на експозитному блоці товщиною 7мм.',
            'marking' => 30007,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30007.jpg'
        ]);

//        papir nabory
        DB::table('products')->insert([
            'group_id' => 7,
            'title' => 'Набір "Shaby baby"',
            'purchase_price' => 12000,
            'price' => 19000,
            'manufacture_id' => 2,
            'quantity' => 12,
            'description' => 'Папір укріїнського виробництва, Фабрика-Декору. Розмір 30 см на 30 см',
            'marking' => 30008,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30008.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 7,
            'title' => 'Набір "Romantic Love"',
            'purchase_price' => 1550,
            'price' => 1950,
            'manufacture_id' => 2,
            'quantity' => 2,
            'description' => 'Папір укріїнського виробництва, Фабрика-Декору. Розмір 30 см на 30 см',
            'marking' => 30009,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30009.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 7,
            'title' => 'Набір "Little ponny"',
            'purchase_price' => 3000,
            'price' => 4500,
            'manufacture_id' => 2,
            'quantity' => 2,
            'description' => 'Папір укріїнського виробництва, Фабрика-Декору. Розмір 30 см на 30 см',
            'marking' => 30010,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30010.jpg'
        ]);

//        papir poshtuchno
        DB::table('products')->insert([
            'group_id' => 8,
            'title' => 'Папір по-штучно Грибочки',
            'purchase_price' => 500,
            'price' => 900,
            'manufacture_id' => 2,
            'quantity' => 10,
            'description' => 'Папір укріїнського виробництва, Фабрика-Декору. Розмір 30 см на 30 см',
            'marking' => 30011,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30011.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 8,
            'title' => 'Папір по-штучно Звірі',
            'purchase_price' => 500,
            'price' => 900,
            'manufacture_id' => 2,
            'quantity' => 8,
            'description' => 'Папір укріїнського виробництва, Фабрика-Декору. Розмір 30 см на 30 см',
            'marking' => 30012,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30012.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 8,
            'title' => 'Папір по-штучно Осінь',
            'purchase_price' => 500,
            'price' => 900,
            'manufacture_id' => 2,
            'quantity' => 0,
            'description' => 'Лазерна вирізка на експозитному блоці товщиною 7мм.',
            'marking' => 30013,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30013.jpg'
        ]);

        // kley
        DB::table('products')->insert([
            'group_id' => 9,
            'title' => 'Клей ФОКУС 100гр',
            'purchase_price' => 3300,
            'price' => 4500,
            'manufacture_id' => 2,
            'quantity' => 3,
            'description' => 'Лазерна вирізка на експозитному блоці товщиною 7мм.',
            'marking' => 30014,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30014.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 9,
            'title' => 'Клей ФД Універсальний 100гр',
            'purchase_price' => 4800,
            'price' => 3000,
            'manufacture_id' => 2,
            'quantity' => 2,
            'description' => 'Лазерна вирізка на експозитному блоці товщиною 7мм.',
            'marking' => 30015,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30015.jpg'
        ]);
        DB::table('products')->insert([
            'group_id' => 9,
            'title' => 'Клей ФД Універсальний 60гр',
            'purchase_price' => 1500,
            'price' => 2500,
            'manufacture_id' => 2,
            'quantity' => 1,
            'description' => 'Лазерна вирізка на експозитному блоці товщиною 7мм.',
            'marking' => 30016,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'main_photo' => '/products_photo/30016.jpg'
        ]);


    }
}