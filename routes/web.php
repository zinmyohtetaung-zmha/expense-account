<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/todo', function () {
    return view('todolist');
})->name('todo');

Route::get('/update', function () {
    return view('update');
})->name('update');

Route::get('/daily', function () {
    return view('dailyreport');
})->name('daily');

// Route::resource('todo_list',ToDoListController::class);

Route::get('/', "ToDoListController@show")->name('showlist');
Route::post('/todolist', "ToDoListController@store")->name('todolist');
Route::get('/delete/{id}', "ToDoListController@destroy")->name('delete');
Route::get('/edit/{id}', "ToDoListController@edit")->name('edit');
Route::post('/update/{id}', "ToDoListController@update")->name('update');


