<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lists;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;


class ListController extends Controller
{

    public function getIndex()
    {
        $lists = Lists::orderBy('created_at', 'desc')->get();

        return view('content.index', compact('lists'));
    }

    public function show($id)
    {
        $list = Lists::find($id);

        return view('content.list', compact('list'));
    }

    public function showAnswers(Request $request, $id)
    {
        $list = Lists::findOrFail($id);

        $validatedData = $request->validate([
            'answers.*' => 'required|integer|min:1|max:10',
        ], [
            'answers.*.required' => 'Alle antwoorden zijn verplicht.',
            'answers.*.integer' => 'Antwoorden moeten getallen zijn van 1 tot 10.',
            'answers.*.min' => 'Antwoorden moeten minimaal 1 zijn.',
            'answers.*.max' => 'Antwoorden mogen maximaal 10 zijn.',
        ]);

        foreach ($list->questions as $question) {
            $answer = $validatedData['answers'][$question->id];
            $question->score = $answer;
            $question->save();
        }

        return redirect()->route('home')->with('success', 'Antwoorden succesvol ingediend!');
    }


    public function getCreate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'questions' => 'required|max:255'
        ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $questions = $request->input('questions');

        $list = Lists::create([
            'title' => $title,
            'description' => $description,
        ]);

        foreach ($questions as $questionData) {
            $question = new Question();
            $question->question = $questionData;

            $list->questions()->save($question);
        }


        return redirect()->route('admin.index')->with('success', 'List created successfully');
    }


    public function postUpdateList(Request $request)
    {


        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'questions' => 'required|array',
            'questions.*' => 'required|max:255',
        ]);

        $list = Lists::find($request->input('id'));

        if (!$list) {
            return redirect()->route('admin.index')->with('error', 'List not found');
        }

        $list->title = $request->input('title');
        $list->description = $request->input('description');
        $list->save();

        // Update questions
        $questions = $request->input('questions');

        $list->questions()->delete(); // Remove existing questions

        foreach ($questions as $question) {
            $list->questions()->create([
                'question' => $question,
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'List updated successfully');
    }


}
