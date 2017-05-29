<?php

use Illuminate\Database\Seeder;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert([
            'user_id' => 1,
            'feedback' => 'Было хорошо, но не очень',
            'adminAnswer' => 'Бывает'
        ]);

        DB::table('feedbacks')->insert([
            'user_id' => 1,
            'feedback' => 'Спасибо, отличный магазин, всё понравилось!',
            'adminAnswer' => 'И Вам спасибо!'
        ]);

        DB::table('feedbacks')->insert([
            'user_id' => 1,
            'feedback' => 'Был однажды здесь, цветовая гамма магазина желает лучшего, я бы например мог разработать Вам дизайн. Мой номер +7809978998',
            'adminAnswer' => 'ПНТ ПНХ'
        ]);

        DB::table('feedbacks')->insert([
            'user_id' => 1,
            'feedback' => 'Выходи за меня!',
            'adminAnswer' => 'НЕТ!'
        ]);
    }
}
