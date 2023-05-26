<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class AnswersSeeder extends Seeder
{
    public function run()
    {
        $questions = Question::all();
        $listId = 1;

        foreach ($questions as $question) {
            $answer = rand(1, 10);

            Answer::create([
                'question_id' => $question->id,
                'list_id' => $listId,
                'answer' => $answer,
            ]);
        }
    }
}

