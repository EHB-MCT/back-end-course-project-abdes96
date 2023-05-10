<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lists;
use App\Models\Question;


class ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $list = Lists::create([
            'title' => 'Example List',
            'description' => 'This is an example list',
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
        ];

        foreach ($questions as $questionData) {
            $question = new Question();
            $question->question = $questionData['question'];
            $question->score = $questionData['score'];

            $list->questions()->save($question);
        }


    }

}
