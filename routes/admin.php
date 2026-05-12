<?php
use Illuminate\Support\Facades\Route;

Route::prefix('dw-admin')
    //->middleware(['web'])
    ->as('admin.')
    ->group(function () {

      Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('home');
     
      Route::middleware('checkRole:Developer,Admin,Creative')->group(function () {
        Route::prefix('master-task')->name('master_task.')->group(function (){
          Route::get('/',[App\Http\Controllers\Admin\MasterTasksController::class,'index'])->name('index');
          Route::post('store',[App\Http\Controllers\Admin\MasterTasksController::class,'store'])->name('store');
          Route::post('data',[App\Http\Controllers\Admin\MasterTasksController::class,'data'])->name('data');
          Route::get('{id}/edit',[App\Http\Controllers\Admin\MasterTasksController::class,'edit'])->name('edit');
          Route::put('{id}/update', [App\Http\Controllers\Admin\MasterTasksController::class, 'update'])->name('update');
          Route::delete('{id}/destroy', [App\Http\Controllers\Admin\MasterTasksController::class, 'destroy'])->name('destroy');

          //Route::get('porting',[App\Http\Controllers\Admin\MasterTasksController::class,'porting'])->name('porting');
        });

        Route::prefix('brand')->name('brand.')->group(function (){
            Route::get('/', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('create');
            Route::post('store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('store');
            Route::post('data', [App\Http\Controllers\Admin\BrandController::class, 'data'])->name('data');
            Route::get('{id}/edit', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('update');
            Route::post('publish', [App\Http\Controllers\Admin\BrandController::class, 'publish'])->name('publish');
            Route::delete('{id}/destroy', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\UserManagement::class, 'index'])->name('index');
            Route::post('data', [App\Http\Controllers\Admin\UserManagement::class, 'dataTable'])->name('data');
            Route::post('/store',[App\Http\Controllers\Admin\UserManagement::class,'store'])->name('store');
            Route::post('/update',[App\Http\Controllers\Admin\UserManagement::class,'update'])->name('update');
            Route::post('/password',[App\Http\Controllers\Admin\UserManagement::class,'password'])->name('password');
            Route::post('/publish',[App\Http\Controllers\Admin\UserManagement::class,'publish'])->name('publish');
            Route::delete('/{id}/delete',[App\Http\Controllers\Admin\UserManagement::class,'destroy'])->name('destroy');
        });

        Route::prefix('summary')->name('summary.')->group(function () {
          Route::get('/', [App\Http\Controllers\Admin\SummaryController::class, 'index'])->name('index');
          Route::post('data', [App\Http\Controllers\Admin\SummaryController::class, 'data'])->name('data');
          Route::get('user', [App\Http\Controllers\Admin\SummaryController::class, 'user'])->name('user');
          Route::post('summary-user', [App\Http\Controllers\Admin\SummaryController::class, 'data_summary_user'])->name('data_summary_user');

          Route::get('brand', [App\Http\Controllers\Admin\SummaryController::class, 'by_brand'])->name('brand');
          Route::post('brand-data', [App\Http\Controllers\Admin\SummaryController::class, 'by_brand_data'])->name('brand_data');

          Route::get('manajerial', [App\Http\Controllers\Admin\SummaryController::class, 'manajerial'])->name('manajerial');
          Route::post('manajerial_data', [App\Http\Controllers\Admin\SummaryController::class, 'manajerial_data'])->name('manajerial_data');

          Route::get('cekgaji', [App\Http\Controllers\Admin\SummaryController::class, 'getGajiDevisi'])->name('getGajiDevisi');
        });

       


      });

      /***--------------------------------------- */
      /*************USER */
      Route::middleware('checkRole:Creative')->group(function (){
        Route::prefix('task')->name('task.')->group(function (){
          Route::get('/', [App\Http\Controllers\CreativeController::class, 'index'])->name('index');
          Route::get('create', [App\Http\Controllers\CreativeController::class, 'create'])->name('create');
          Route::post('store',[App\Http\Controllers\CreativeController::class,'store'])->name('store');
          Route::post('data',[App\Http\Controllers\CreativeController::class,'data'])->name('data');
          Route::get('{id}/edit', [App\Http\Controllers\CreativeController::class, 'edit'])->name('edit');
          Route::put('{id}/update', [App\Http\Controllers\CreativeController::class, 'update'])->name('update');
          Route::delete('/{id}/delete',[App\Http\Controllers\CreativeController::class,'destroy'])->name('destroy');
        });

        Route::prefix('man')->name('manajerial.')->group(function (){
          Route::get('/', [App\Http\Controllers\ManajerialController::class, 'index'])->name('index');
          Route::get('create', [App\Http\Controllers\ManajerialController::class, 'create'])->name('create');
          Route::post('store',[App\Http\Controllers\ManajerialController::class,'store'])->name('store');
          Route::post('data',[App\Http\Controllers\ManajerialController::class,'data'])->name('data');
          Route::get('{id}/edit', [App\Http\Controllers\ManajerialController::class, 'edit'])->name('edit');
          Route::put('{id}/update', [App\Http\Controllers\ManajerialController::class, 'update'])->name('update');
          Route::delete('/{id}/delete',[App\Http\Controllers\ManajerialController::class,'destroy'])->name('destroy');
        });

      });

});