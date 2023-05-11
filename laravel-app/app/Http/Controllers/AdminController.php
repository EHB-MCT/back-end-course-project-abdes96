<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\Lists;
use App\Models\Question;

use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }
    public function getIndex()
    {
        $lists = Lists::with('questions')->orderBy('created_at', 'desc')->get();

        return view('admin.index', ['lists' => $lists]);
    }
    public function getCreate()
    {
        return view('admin.create');
    }

    public function getEdit($id)
    {
        $list = Lists::find($id);
        return view('admin.edit', ['list'=>$list]);
    }




    public function deleteItem($id)
    {
        $list = Lists::find($id);

            $list->delete();
        return redirect()->action([AdminController::class, 'getIndex'])->with('success', 'List deleted successfully!');;



    }




}
