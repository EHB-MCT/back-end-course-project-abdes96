<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function showQuestionnaire()
    {
        // Retrieve the questionnaire data from your database
        // and pass it to the view
        $questionnaire = Questionnaire::find(1);
        return view('public.questionnaire', compact('questionnaire'));
    }

}
