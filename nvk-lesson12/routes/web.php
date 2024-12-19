<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/admins/nvk-login',[NVK_QUAN_TRIController::class,'nvkLogin'])->name('admin.nvkLogin');
Route::post('/admins/nvk-login',[NVK_QUAN_TRIController::class,'nvkLoginSubmit'])->name('admin.nvkLoginSubmit');