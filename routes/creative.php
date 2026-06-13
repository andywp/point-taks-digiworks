<?php
use Illuminate\Support\Facades\Route;



Route::prefix('creative')->middleware(['auth:admin','checkRole:Creative'])->as('creative.')->group(function () {
    Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('home');
    Route::prefix('point-teknis')->name('task.')->group(function (){
        Route::get('/', [App\Http\Controllers\CreativeController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\CreativeController::class, 'create'])->name('create');
        Route::post('store',[App\Http\Controllers\CreativeController::class,'store'])->name('store');
        Route::post('data',[App\Http\Controllers\CreativeController::class,'data'])->name('data');
        Route::get('{id}/edit', [App\Http\Controllers\CreativeController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [App\Http\Controllers\CreativeController::class, 'update'])->name('update');
        Route::delete('/{id}/delete',[App\Http\Controllers\CreativeController::class,'destroy'])->name('destroy');
    });

    Route::prefix('manajerial')->name('manajerial.')->group(function (){
        Route::get('/', [App\Http\Controllers\ManajerialController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\ManajerialController::class, 'create'])->name('create');
        Route::post('store',[App\Http\Controllers\ManajerialController::class,'store'])->name('store');
        Route::post('data',[App\Http\Controllers\ManajerialController::class,'data'])->name('data');
        Route::get('{id}/edit', [App\Http\Controllers\ManajerialController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [App\Http\Controllers\ManajerialController::class, 'update'])->name('update');
        Route::delete('/{id}/delete',[App\Http\Controllers\ManajerialController::class,'destroy'])->name('destroy');
    });
});