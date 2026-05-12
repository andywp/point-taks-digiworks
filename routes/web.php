<?php

use Illuminate\Support\Facades\Route;
// /use \Meta;

Auth::routes([
    'login' => false,
    'register' => false,
]);
//Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
    //Route::view('/','auth.login')->name('login');
    Route::get('/', function () {
        \Meta::set('title', 'Login');
        //Meta::set('description', 'Login');
        return view('auth.login');
    })->name('login');

    Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'check'])->name('login_check');
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
//});

 //Route::get('porting', [App\Http\Controllers\PortingController::class, 'index'])->name('porting');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('porting',[App\Http\Controllers\Admin\MasterTasksController::class,'porting'])->name('porting');
