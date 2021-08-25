<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//----------
Route::middleware('is_admin')->group(function () {
    Route::get('/books/create', 'App\Http\Controllers\BookController@create');

    Route::post('/books/store', '\App\Http\Controllers\BookController@store');

    Route::get('/books/{book}/edit', 'App\Http\Controllers\BookController@edit')->name('books.edit');

    Route::post('/books/update/{id}', '\App\Http\Controllers\BookController@update');

    Route::get('/books/delete/{id}', '\App\Http\Controllers\BookController@delete');

    Route::get('/category/create', 'App\Http\Controllers\CategoryController@create');

    // Route::post('category/create', 'App\Http\Controllers\CategoryController@store');
    Route::post('category/create', [CategoryController::class, 'store']);
});
Route::middleware('is_user')->group(function () {
    Route::get('/books', 'App\Http\Controllers\BookController@index');
    Route::get('/books/{id}', 'App\Http\Controllers\BookController@show');


    Route::get('users/notes', 'App\Http\Controllers\UserController@notes');
    Route::post('users/notes', 'App\Http\Controllers\UserController@handleNotes');
});

//----------

Route::get('users/register', 'App\Http\Controllers\UserController@registerForm');
Route::post('users/register', 'App\Http\Controllers\UserController@handleRegister');

Route::get('users/login', 'App\Http\Controllers\UserController@loginForm');
Route::post('users/login', 'App\Http\Controllers\UserController@handleLogin');

Route::get('users/logout', 'App\Http\Controllers\UserController@logout');
