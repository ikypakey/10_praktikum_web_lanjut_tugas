<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiwaController;
use Illuminate\Http\Request;

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

Route::resource('/mahasiswa', MahasiwaController::class);
Route::get('mahasiswa/nilai/{id_mahasiswa}', [MahasiwaController::class, 'nilai'])->name('nilai');