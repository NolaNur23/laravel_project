<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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

Route::get('hash-make', function () {
    return Hash::make("123123");
});
// Route::get()
Route::get('/', [App\http\Controllers\LandingpageController::class, 'index'])->name('index');
Route::get('/login', [App\http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/register', [App\http\Controllers\RegisterController::class, 'index']);
Route::post('/register/createData', [App\http\Controllers\RegisterController::class, 'create']);

Route::post('/auth-login', [App\http\Controllers\LoginController::class, 'login'])->name('auth-login');
Route::get('logout', function () {
    Auth::logout();
    return Redirect('/');
});
Route::middleware(['checkLevel:ADMIN'])->group(function () {
    Route::prefix('category2')->group(function () {
        Route::get('/', [App\http\Controllers\Category2Controller::class, 'index']);
        Route::get('/getData', [App\http\Controllers\Category2Controller::class, 'getData']);
        Route::post('/createData', [App\http\Controllers\Category2Controller::class, 'createData']);
        Route::post('/updateData/{id}', [App\http\Controllers\Category2Controller::class, 'updateData']);
        Route::post('/deleteData/{id}', [App\http\Controllers\Category2Controller::class, 'deleteData']);
    });
});

Route::middleware(['web'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('welcome');
    // });
    // '/dashboard= endpoint                               'index'= nama controller    name('dashboard') =inisiasi pemanggilan
    // endpoint akan di panggil oleh frontend
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::prefix('category')->group(function () {
        Route::get('/', [App\http\Controllers\CategoryController::class, 'index'])->name('category');
        Route::get('/search', [App\http\Controllers\CategoryController::class, 'searchData'])->name('search');
        Route::get('/create', [App\http\Controllers\CategoryController::class, 'create'])->name('categoryCreate');
        Route::post('/store', [App\http\Controllers\CategoryController::class, 'store'])->name('categoryStore');
        Route::get('/edit/{id}', [App\http\Controllers\CategoryController::class, 'edit'])->name('categoryEdit');
        Route::post('/update/{id}', [App\http\Controllers\CategoryController::class, 'update'])->name('categoryUpdate');
        Route::post('/destroy/{id}', [App\http\Controllers\CategoryController::class, 'destroy'])->name('categoryDestroy');
    });

    // Route::prefix('category2')->group(function () {
    //     Route::get('/', [App\http\Controllers\Category2Controller::class, 'index']);
    //     Route::get('/getData', [App\http\Controllers\Category2Controller::class, 'getData']);
    //     Route::post('/createData', [App\http\Controllers\Category2Controller::class, 'createData']);
    //     Route::post('/updateData/{id}', [App\http\Controllers\Category2Controller::class, 'updateData']);
    //     Route::post('/deleteData/{id}', [App\http\Controllers\Category2Controller::class, 'deleteData']);
    // });
    Route::prefix('news')->group(function () {
        Route::get('/', [App\http\Controllers\NewsController::class, 'index']);
        Route::get('/getData', [App\http\Controllers\NewsController::class, 'getData']);
        Route::get('/getDataRestore', [App\http\Controllers\NewsController::class, 'getDataRestore']);
        Route::post('/createData', [App\http\Controllers\NewsController::class, 'Create']);
       
        Route::post('/deleteData/{id}', [App\http\Controllers\NewsController::class, 'deleteData']);
        
        Route::get('/restore', [App\http\Controllers\NewsController::class, 'indexRestore']);

        Route::post('/restoreData/{id}', [App\http\Controllers\NewsController::class, 'restoreData']);
        Route::get('/deletePermanentData', [App\http\Controllers\NewsController::class, 'deletePermanentData']);
        // updateData
        // Route::post('/createData', [App\http\Controllers\NewsController::class, 'Create']);

    });
    Route::prefix('user')->group(function () {
        Route::get('/profile/getData', [App\http\Controllers\profileController::class, 'getProfile']);
        Route::get('/profile', [App\http\Controllers\profileController::class, 'index']);
        Route::get('/data', [App\http\Controllers\RegisterController::class, 'getData']);
        Route::post('/updateData/{id}', [App\http\Controllers\RegisterController::class, 'update']);
        Route::post('/updatePassword/{id}', [App\http\Controllers\RegisterController::class, 'updatePassword']);

    });
});
