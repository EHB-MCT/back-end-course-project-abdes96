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
            'title' => 'Beoordeel je eerste sessie',
            'description' => 'Een lijst met vragen om feedback te verzamelen van klanten na een kinesissessie. De vragen helpen bij het evalueren van de algehele ervaring, nut van oefeningen, opvolgen van instructies, uitdaging en behaalde resultaten.',
            'completed' => true,
            'list_type' => 'multiple',

        ]);

        $questions = [
            [
                'question' => 'Hoe zou je de algehele ervaring van de kinesissessie beoordelen? (1-10)',
                'score' => 5,
                'list_id' => $list->id,
            ],
            [
                'question' => 'In hoeverre heb je gemerkt dat je flexibiliteit en mobiliteit zijn verbeterd na de Kinesis therapie? (1-10)',
                'score' => 8,
                'list_id' => $list->id,
            ],
            [
                'question' => 'Hoe goed kon je je concentreren en focussen tijdens de Kinesis therapie? (1-10)',
                'score' => 3,
                'list_id' => $list->id,
            ],
            [
                'question' => 'In welke mate heb je een gevoel van welzijn en ontspanning ervaren na de Kinesis therapie? (1-10)',
                'score' => 6,
                'list_id' => $list->id,
            ],
            [
                'question' => 'In welke mate heb je een gevoel van welzijn en ontspanning ervaren na de Kinesis therapie? (1-10)',
                'score' => 9,
                'list_id' => $list->id,
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
