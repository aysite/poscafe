<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

// Route Category
Route::resource('category',CategoryController::class);

// Route Kitchen
Route::resource('kitchen',KitchenController::class);

// Route Menu
Route::resource('menu',MenuController::class);

// Route Table
Route::get('table',[TableController::class,'index'])->name('table.index');
Route::post('table/save',[TableController::class,'save'])->name('table.save');
Route::delete('table/{table}',[TableController::class,'destroy'])->name('table.destroy');