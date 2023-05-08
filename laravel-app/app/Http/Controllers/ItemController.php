<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function getIndex()
    {

        $items = Item::orderby('created_at', 'desc')->get();

        return view('content.index', ['items' => $items]);

    }

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
