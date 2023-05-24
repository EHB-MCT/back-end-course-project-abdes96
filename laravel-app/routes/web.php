<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });



require __DIR__.'/auth.php';


Route::get('/', [
    'uses' => 'App\Http\Controllers\ListController@getIndex',
    'as' => 'home'
]);

Route::get('/lists/{id}', [
    'uses' => 'App\Http\Controllers\ListController@show',
    'as' => 'lists'
]);
Route::post('listsAnswers/{id}', [
    'uses' => 'App\Http\Controllers\ListController@showAnswers',
    'as' => 'answer'
]);







Route::get('/item', [
    'uses' => 'App\Http\Controllers\ItemController@getItem',
    'as' => 'item'
]);


//create item route
Route::post('/listcreation', [
    'uses' => 'App\Http\Controllers\ListController@getCreate',
    'as' =>'ListCreate'
]);

Route::post('/listupdated', [
    'as' => 'admin.update',
    'uses' => 'App\Http\Controllers\ListController@postUpdateList'
]);
// edit item route
Route::post('/itemedit', function () {
    return redirect()->route('admin.index');

})->name('');

//admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
//home
    Route::get('', [
        'uses' => 'App\Http\Controllers\AdminController@getIndex',
        'as' => 'admin.index',

    ]);

    Route::get('/stats/{id}', [
        'uses' => 'App\Http\Controllers\AdminController@getStatistics',
        'as' => 'list.statistics',

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



    Route::get('delete/{id}', [
        'as' => 'admin.delete',
        'uses' => 'App\Http\Controllers\AdminController@deleteItem'
    ]);
});
