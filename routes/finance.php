<?php
use Illuminate\Support\Facades\Route;



Route::prefix('finance')->middleware(['auth:admin','checkRole:Finance'])->as('finance.')->group(function () {
    Route::get('/',[App\Http\Controllers\Finance\DashboardController::class,'index'])->name('home');
    Route::prefix('point-teknis')->name('task.')->group(function (){
        Route::get('/', [App\Http\Controllers\Finance\PointTeknisController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Finance\PointTeknisController::class, 'create'])->name('create');
        Route::post('store',[App\Http\Controllers\Finance\PointTeknisController::class,'store'])->name('store');
        Route::post('data',[App\Http\Controllers\Finance\PointTeknisController::class,'data'])->name('data');
        Route::get('{id}/edit', [App\Http\Controllers\Finance\PointTeknisController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [App\Http\Controllers\Finance\PointTeknisController::class, 'update'])->name('update');
        Route::delete('/{id}/delete',[App\Http\Controllers\Finance\PointTeknisController::class,'destroy'])->name('destroy');
    });

    Route::prefix('manajerial')->name('manajerial.')->group(function (){
        Route::get('/', [App\Http\Controllers\Finance\ManajerialController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Finance\ManajerialController::class, 'create'])->name('create');
        Route::post('store',[App\Http\Controllers\Finance\ManajerialController::class,'store'])->name('store');
        Route::post('data',[App\Http\Controllers\Finance\ManajerialController::class,'data'])->name('data');
        Route::get('{id}/edit', [App\Http\Controllers\Finance\ManajerialController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [App\Http\Controllers\Finance\ManajerialController::class, 'update'])->name('update');
        Route::delete('/{id}/delete',[App\Http\Controllers\Finance\ManajerialController::class,'destroy'])->name('destroy');
    });
});