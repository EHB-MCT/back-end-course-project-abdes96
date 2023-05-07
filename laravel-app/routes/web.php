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
Route::get('/', [
    'uses' => 'App\Http\Controllers\ItemController@getIndex',
    'as' => 'home'
]);


Route::get('/about', function () {
    return view('other.about');
})->name('about');

Route::get('/item/{id}', [
    'uses' => 'App\Http\Controllers\ItemController@getItem',
    'as' => 'item'
]);


//create item route
Route::post('/itemcreate', [
    'uses' => 'App\Http\Controllers\ItemController@postCreateItem',
    'as' =>'itemcreate'
]);

// edit item route
Route::post('/itemedit', function () {
    return redirect()->route('admin.index');

})->name('');

//admin routes
Route::group(['prefix' => 'admin'], function () {
//home
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
    Route::get('edit/{id}', [
        'as' => 'admin.edit',
        'uses' => 'App\Http\Controllers\AdminController@getEdit'
    ]);

    // Update
    Route::post('update', [
        'as' => 'admin.update',
        'uses' => 'App\Http\Controllers\AdminController@postUpdateItem'
    ]);

    Route::get('delete/{id}', [
        'as' => 'admin.delete',
        'uses' => 'App\Http\Controllers\AdminController@deleteItem'
    ]);


});


