<?php
use Illuminate\Support\Facades\Route;

Route::get('books', 'App\Http\Controllers\ApiController@showBooks');
Route::get('books/show/{id}', 'App\Http\Controllers\ApiController@showBook');
Route::post('books/store', 'App\Http\Controllers\ApiController@storeBook');
Route::get('users', 'App\Http\Controllers\ApiController@showUsers');
