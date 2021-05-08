<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController; //! also need to include controller path

//TODO: https://laravel.com/docs/8.x/routing
//TODO: https://laravel.com/docs/8.x/middleware

//TODO: make a controller ->  php artisan make:controller controllername
//TODO: make a middleware ->  php artisan make:middleware EnsureTokenIsValid

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo 'This is home page';
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');

//http://127.0.0.1:8000/about?check=25

//? get url request using controller with laravel 6, 7
// Route::get('/contact', 'ContactController@index'); //! this wouldn't work in laravel 8

//? this is laravel 8 systax to get url request using controller
Route::get('/contact', [ContactController::class, 'index']);
