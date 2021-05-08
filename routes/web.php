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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact-page-test', function () {
    // echo "<h1>it's contact page</h1>";
    return view('contact');
})->name('con');
