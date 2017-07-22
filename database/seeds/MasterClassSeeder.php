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

        DB::table('master_class')->insert([
            'title' => 'Шкатулка с ретро-замочком',
            'description' => 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги "de Finibus Bonorum et Malorum" ("О пределах добра и зла"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, "Lorem ipsum dolor sit amet..", происходит от одной из строк в разделе 1.10.32',
            'master' => 'Кулеба Татьяна',
            'technology' => 'Декупаж',
            'max_seats' => 6,
            'full_seets' => 0,
            'max_age' => 18,
            'duration' => 2,
            'price' => 225,
            'main_photo' => '/mk_photo/mk2.jpg',
            'place' => 'ТЦ ПетроЦентр, Коцюбинського 40А',
            'date_time' => '2017-09-20 12:00:00',
            'status' => 'active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
