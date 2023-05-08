<?php
namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
public function store(Request $request)
{
$validatedData = $request->validate([
'text' => 'required|max:255',
'score' => 'required|integer|min:1|max:10',
'list_id' => 'required|exists:lists,id',
]);

$question = new Question();
$question->text = $validatedData['text'];
$question->score = $validatedData['score'];
$question->list_id = $validatedData['list_id'];
$question->save();

return redirect()->back()->with('success', 'Vraag is toegevoegd aan.');
}

public function destroy(Question $question)
{
$question->delete();

return redirect()->back()->with('success', 'vraag deleted .');
}

    public function edit(Lists $list, Question $question)
{
    return view('questions.edit', compact('list', 'question'));
}

public function update(Request $request, Lists $list, Question $question)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'question' => 'required|max:255',
    ]);

    $question->update($validatedData);

    return redirect()->route('lists.show', $list)
        ->with('success', 'Question updated successfully');
}





}
