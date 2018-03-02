<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Answer;

class QuestionAndAnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $question = Question::create([
            'question' => 'Around what time did you wake up today? (round to earliest time)'
        ]);

        $question->answers()->createMany([
            ['answer' => '6:00 AM'],
            ['answer' => '7:00 AM'],
            ['answer' => '8:00 AM'],
            ['answer' => '9:00 AM'],
        ]);

        $question = Question::create([
            'question' => 'Was your normal train on time today?'
        ]);

        $question->answers()->createMany([
            ['answer' => 'Yes'],
            ['answer' => 'Few Minutes Early'],
            ['answer' => 'Few Minutes Late'],
        ]);

        $question = Question::create([
            'question' => 'Did you exercise today?'
        ]);

        $question->answers()->createMany([
            ['answer' => 'Yes'],
            ['answer' => 'No'],
        ]);

        $question = Question::create([
            'question' => 'What kind of shirt did you wear today?'
        ]);

        $question->answers()->createMany([
            ['answer' => 'Button Down (Long Sleeve)'],
            ['answer' => 'Button Down (Short Sleeve)'],
            ['answer' => 'Polo'],
            ['answer' => 'T-Shirt'],
        ]);
    }
}
