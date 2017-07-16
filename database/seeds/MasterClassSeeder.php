<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_class')->insert([
            'title' => 'Зайка вухастик',
            'description' => 'Создавая тильдовского зайку-ушастика вы узнаете секреты работы с текстильными материалами, особенности изготовления игрушки "тильда", проведете время в компании творческих людей и порадуйте себя и близких чудесным добрым сувениром. Возраст участников от 12 до 100 лет. Материалы входят в стоимость МК. ',
            'master' => 'Блащук Лариса',
            'technology' => 'Кукла тильда',
            'max_seats' => 6,
            'full_seets' => 0,
            'max_age' => 15,
            'duration' => 3,
            'price' => 180,
            'main_photo' => '/mk_photo/mk1.jpg',
            'place' => 'ТЦ ПетроЦентр, Коцюбинського 40А',
            'date_time' => '2018-07-19 16:35:00',
            'status' => 'active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
