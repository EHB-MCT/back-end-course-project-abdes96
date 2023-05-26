<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lists;
use App\Models\Question;
use App\Models\Answer;


class ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $list = Lists::create([
            'title' => 'Example List singuse',
            'description' => 'This is an example list',
            'completed' => true,
            'list_type' => 'single',

        ]);

        $questions = [
            [
                'question' => 'Question 1',
                'score' => 5,
            ],
            [
                'question' => 'Question 2',
                'score' => 8,
            ],
            [
                'question' => 'Question 3',
                'score' => 8,
            ],
            [
                'question' => 'Question 4',
                'score' => 8,
            ],
            [
                'question' => 'Question 5',
                'score' => 8,
            ],
        ];

        foreach ($questions as $questionData) {
            $question = new Question();
            $question->question = $questionData['question'];
            $question->score = $questionData['score'];

            $list->questions()->save($question);

            $answer = new Answer();
            $answer->list_id = $list->id;
            $answer->question_id = $question->id;
            $answer->answer = $questionData['score'];
            $answer->save();
        }


    }

}
