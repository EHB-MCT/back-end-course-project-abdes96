<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Lists;
class QuestionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = Lists::where('title', 'Sample List')->first();

        $questions = [
            [
                'question' => 'Question 1',
                'score' => 5,
                'list_id' => $list->id,
            ],
            [
                'question' => 'Question 2',
                'score' => 8,
                'list_id' => $list->id,
            ],
            [
                'question' => 'Question 3',
                'score' => 3,
                'list_id' => $list->id,
            ],
            [
                'question' => 'Question 4',
                'score' => 6,
                'list_id' => $list->id,
            ],
            [
                'question' => 'Question 5',
                'score' => 9,
                'list_id' => $list->id,
            ],
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }
}
