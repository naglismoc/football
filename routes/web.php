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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'stadia'], function(){
    Route::get('/', [App\Http\Controllers\StadiumController::class, 'index'])->name('stadia.index');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/create', [App\Http\Controllers\StadiumController::class, 'create'])->name('stadia.create');
        Route::post('/store', [App\Http\Controllers\StadiumController::class, 'store'])->name('stadia.store');
        
    });

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
