<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class ItemController extends Controller
{
    //



    public function getItem($id){
        $item = Item::where('id',$id)->first();
        return view('content.item', ['item' => $item]);


    }
    public function postCreateItem(Request $request)
    {
        $this->validate($request, [

            'title' => 'required|max:20',
            'content' => 'required'
        ]);
        $item = new item([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $item->save();
        return redirect()->route('home')->with('success', 'Item created successfully!');


    }


}
