<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lists;
use App\Models\Question;


class ListController extends Controller
{
    public function getIndex()
    {
        $lists = auth()->user()->lists;
        return view('admin.index', compact('lists'));
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
}
