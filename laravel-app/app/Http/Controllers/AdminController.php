<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex()
    {
        return view('admin.index');
    }
    public function getCreate()
    {
        return view('admin.create');
    }

    public function getEdit()
    {
        return view('admin.edit');
    }
}
