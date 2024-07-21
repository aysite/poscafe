<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;


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

Route::group(["middleware"=>"auth"],function(){
    
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::group(["middleware"=>"superadmin"],function(){
        Route::resource('user',UserController::class);
    });

    Route::group(["middleware"=>"admin"],function(){
    // Route Category
    Route::resource('category',CategoryController::class);
    Route::resource('kitchen',KitchenController::class);
    Route::resource('menu',MenuController::class);
    
    // Route Table
    Route::get('table',[TableController::class,'index'])->name('table.index');
    Route::post('table/save',[TableController::class,'save'])->name('table.save');
    Route::delete('table/{table}',[TableController::class,'destroy'])->name('table.destroy');
    });
    
    Route::group(["middleware"=>"cashier"],function(){
    // Transaction
    Route::get('transaction',[TransactionController::class,'index'])->name('trans.index');
    Route::get('transaction/form',[TransactionController::class,'create'])->name('trans.create');
    Route::get('transaction/status/{id_trans}/{status}',[TransactionController::class,'update'])->name('trans.status');
    Route::get('transaction/cetak/{no_trans}',[TransactionController::class,'cetak'])->name('trans.cetak');
    Route::post('transaction/save',[TransactionController::class,'store'])->name('trans.store');
    });

    Route::get('logout',[AuthController::class,'cek_logout'])->name('auth.logout');
});
// Route Login, Cek Login, Logout
Route::get('login',[AuthController::class,'index'])->name('auth.login');
Route::post('auth',[AuthController::class,'cek_login'])->name('authentication');


