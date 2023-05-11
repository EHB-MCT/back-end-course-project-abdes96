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
        $item = Item::find($id);
        return view('admin.edit', ['item'=>$item]);
    }


    public function postUpdateItem(Request $request) {

        $this->validate($request, [

            'title' => 'required|min:5',
            'content' => 'required'
        ]);

        $item = item::find($request->input('id'));
        //updating
        $item ->title= $request->input('title');
        $item ->content= $request->input('content');
        $item->save();
        return redirect()->route('admin.index')->with('success', 'Item updated successfully!');

    }

    public function deleteItem($id)
    {
        $list = Lists::find($id);

            $list->delete();
        return redirect()->action([AdminController::class, 'getIndex'])->with('success', 'List deleted successfully!');;



    }




}
