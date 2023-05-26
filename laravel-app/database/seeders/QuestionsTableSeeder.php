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
            Question::create($questionData);
        }
    }
}
