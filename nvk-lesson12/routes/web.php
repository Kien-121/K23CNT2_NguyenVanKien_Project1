<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NVK_LOAI_SAN_PHAMController;
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

#Admins + route
Route::get('/nvk-admins/',function(){
    return view('nvkAdmins.index');
});

Route::get('/nvk-admins/nvk-loai-san-pham',[NVK_LOAI_SAN_PHAMController::class,'nvklist'])->name('nvkadmins.nvkloaisanpham');
Route::get('/nvk-admins/nvk-loai-san-pham/nvk-create',[NVK_LOAI_SAN_PHAMController::class,'nvkCreate'])->name('nvkadmins.nvkloaisanpham.nvkcreate');
Route::post('/nvk-admins/nvk-loai-san-pham/nvk-create',[NVK_LOAI_SAN_PHAMController::class,'nvkCreateSubmit'])
 ->name('nvkadmins.nvkloaisanpham.nvkcreatesubmit');
#nvkadmins.nvkloaisanpham.nvkcreate

Route::get('/nvk-admins/nvk-loai-san-pham/nvkedit/{id}', [NVK_LOAI_SAN_PHAMController::class, 'nvkedit'])->name('nvkadmins.nvkloaisanpham.nvkedit');
Route::post('/nvk-admins/nvk-loai-san-pham/nvkedit', [NVK_LOAI_SAN_PHAMController::class, 'nvkeditSubmit'])->name('nvkadmins.nvkloaisanpham.nvkeditSubmit');

//delete
Route::get('/nvk-admins/nvk-loai-san-pham/nvkdelete/{id}', [NVK_LOAI_SAN_PHAMController::class, 'nvkDelete'])->name('nvkadmins.nvkloaisanpham.nvkdelete');