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
        Route::get('/show/{Stadium}', [App\Http\Controllers\StadiumController::class, 'show'])->name('stadia.show');
        
    });

});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'reg'], function(){
        // Route::get('/', [App\Http\Controllers\StadiumController::class, 'index'])->name('reg.index');
   
        // Route::get('/create', [App\Http\Controllers\StadiumController::class, 'create'])->name('reg.create');
        Route::post('/store', [App\Http\Controllers\RegistrationController::class, 'store'])->name('reg.store');
        Route::post('/delete/{Registration}', [App\Http\Controllers\RegistrationController::class, 'destroy'])->name('reg.delete');
        // Route::get('/show/{Stadium}', [App\Http\Controllers\StadiumController::class, 'show'])->name('reg.show');
        
    });

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
