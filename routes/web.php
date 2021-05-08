<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController; //! also need to include controller path

//! here we create web route
//? laravel have 6 types of routes
/**
 //* GET --> when you have to show some content you have to use get method
 //* POST --> when you have to insert some of the data in database you have to use post method
 //* PUT --> when you want to update some data into database you have to use put method
 //* DELETE  --> when you want to delete some data from database you have use delete method
 //* PATCH --> when you want to update one single field you have to use patch method
 //* OPTIONS
 */

//TODO: make a controller ->  php artisan make:controller controllername

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

//? get url request using controller with laravel 6, 7
// Route::get('/contact', 'ContactController@index'); //! this wouldn't work in laravel 8

//TODO: https://laravel.com/docs/8.x/routing
//? this is laravel 8 systax to get url request using controller
Route::get('/contact', [ContactController::class, 'index']);
