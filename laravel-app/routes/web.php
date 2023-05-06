<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//generic routes
Route::get('/',[
    'uses'=>'App\Http\Controllers\ItemController@getIndex',
    'as'=> 'home'
]);


Route::get('/about', function () {
    return view('other.about');
})->name('about');

Route::get('/item/{id}', function ($id) {
    return view('content.item' , ['nieuweVar'=>$id]);
})->name('item');


//create item route
Route::post('/itemcreate', function(\Illuminate\Http\Request $request , Illuminate\Validation\Factory $validator) {

    $validator->make($request->all(),[
        'title' => 'required|min:5',
        'content' => 'required',
    ])->validate();

    //$data = $request->all();
    $title = $request->input('title');
    return redirect( 'admin')->with('forminput',$title);

})->name('itemcreate');

// edit item route
Route::post('/itemedit', function() {
    return redirect()->route('admin.index');

})->name('');

//admin routes
Route::group(['prefix' => 'admin'], function () {

    Route::get('', [
        'uses' => 'App\Http\Controllers\AdminController@getIndex',
        'as' => 'admin.index',

    ]);

    // Create
    Route::get('create', [
        'as' => 'admin.create',
        'uses' => 'App\Http\Controllers\AdminController@getCreate'
    ]);

    // Edit
    Route::get('edit', [
        'as' => 'admin.edit',
        'uses' => 'App\Http\Controllers\AdminController@getEdit'
    ]);

});


