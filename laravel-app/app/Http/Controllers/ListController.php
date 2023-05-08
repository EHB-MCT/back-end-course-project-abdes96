<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionaireController  extends Controller
{

    public function getIndex()
    {
        $lists = auth()->user()->lists;
        return view('admin.index', compact('lists'));
    }


}
