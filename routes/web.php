<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;  //database query builder
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiImageController;
// use app\models\User;

//TODO: create a new database table -> php artisan migrate
//TODO: learn create model and migration https://laravel.com/docs/8.x/eloquent
//TODO: create model and migration -> php artisan make:model modelname -m
//TODO: Create controller -> php artisan make:controller  controllername

Route::get('/', function () {
    return view('auth/register');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    // echo "<h1>it's contact page</h1>";
    return view('contact');
});

//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

//Add Category
Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('add.category');

//Edit Category
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCategory']);

//Update Category
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCategory']);

//Delete Category
Route::get('/category/delete/{id}', [CategoryController::class, 'SoftdeleteCategory']);

//Restore Category
Route::get('/category/restore/{id}', [CategoryController::class, 'RestoreCategory']);

//Delete Permanently Category
Route::get('/category/pdelete/{id}', [CategoryController::class, 'DeleteCategory']);

//* 😍 for brand route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

//Add Brand
Route::post('/brnad/add', [BrandController::class, 'AddBrand'])->name('store.brand');

//Edit Brand
Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand']);

//Update Brand
Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand']);

//Delete brand
Route::get('/brand/delete/{id}', [BrandController::class, 'DeleteBrand']);

//* 😎 Multi image route
Route::get('/multi-image', [MultiImageController::class, 'MultiImage'])->name('multi.image');
Route::post('/multi-image/upload', [MultiImageController::class, 'UploadImages'])->name('store.image');

//TODO: php jetstring authentication -> https://jetstream.laravel.com/2.x/installation.html

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();  //useful when we use modal
    // return view('dashboard', compact('users'));

    //TODO: read query builder -> https://laravel.com/docs/8.x/queries
    $users = DB::table('users')->get();
    return view('dashboard', ['users' => $users]);
})->name('dashboard');
