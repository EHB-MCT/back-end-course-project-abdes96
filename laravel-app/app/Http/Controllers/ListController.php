<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lists;
use App\Models\Question;
use App\Models\Answer;

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

        foreach ($validatedData['answers'] as $questionId => $answer) {
            $question = Question::findOrFail($questionId);
            $question->score = $answer;
            $question->save();

            $answerModel = new Answer();
            $answerModel->list_id = $list->id;
            $answerModel->question_id = $question->id;
            $answerModel->answer = $answer;
            $answerModel->save();
        }

        $list->completed = true;
        $list->save();

        return redirect()->route('home')->with('success', 'Antwoorden succesvol ingediend!');
    }

    protected function handleAction(Request $request)
    {
        if ($request->has('preview')) {

            return $this->showPreview($request);
        } else {
            return $this->getCreate($request);
        }
    }


    protected function showPreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'name' => 'required_if:list_type,single|max:255',
            'list_type' => 'required|in:single,multiple',
            'questions' => 'required|array|min:5',
            'questions.*' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            // Validation failed, return JSON response with errors
            return response()->json(['errors' => $validator->errors()]);
        } else {
            // Validation passed, return HTML response with the preview
            $title = $request->input('title');
            $description = $request->input('description');
            $name = $request->input('name');
            $questions = $request->input('questions');
            $type = $request->input('list_type');

            $list = [
                'title' => $title,
                'description' => $description,
                'client' => $name,
                'list_type' => $type,
                'questions' => $questions,
            ];

            $previewHtml = view('admin.listPreview', compact('list'))->render();

            return response()->json(['previewHtml' => $previewHtml]);
        }
    }

    public function getCreate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'name' => 'required_if:list_type,single|max:255',
            'list_type' => 'required|in:single,multiple',
            'questions' => 'required|array|min:5',
            'questions.*' => 'required|max:255',
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $name = $request->input('name');
        $questions = $request->input('questions');
        $type = $request->input('list_type');


        $list = Lists::create([
            'title' => $title,
            'description' => $description,
            'client' => $name,
            'list_type' => $type,

        ]);

        foreach ($questions as $questionData) {
            $question = new Question();
            $question->question = $questionData;

            $list->questions()->save($question);
        }

        $url = route('lists', ['id' => $list->id]);


        return redirect()->route('admin.index')->with('success', 'List created successfully.URL: '.$url);
    }


    public function postUpdateList(Request $request) {



            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required|min:10',
                'questions' => 'required|array',
                'questions.*' => 'required|max:255',
                'list_type' => 'required|in:single,multiple',

            ]);

            $list = Lists::find($request->input('id'));

            if (!$list) {
                return redirect()->route('admin.index')->with('error', 'List not found');
            }

            $list->title = $request->input('title');
            $list->description = $request->input('description');
        $list->list_type = $request->input('list_type');


        if ($request->has('name')) {
            $list->client = $request->input('name');
        }
            $list->save();


            // Update questions
            $questions = $request->input('questions');

            $list->questions()->delete(); // Remove existing questions

            foreach ($questions as $question) {
                $list->questions()->create([
                    'question' => $question,
                ]);
            }
        $url = route('lists', ['id' => $list->id]);

        return redirect()->route('admin.index')->with('success', 'List updated successfully! URL: '.$url);
        }



}
