<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\BarangController;
Use App\Http\Controllers\ProjectController;
Use App\Http\Controllers\TenagaKerjaController;
Use App\Http\Controllers\ToolsInOutController;
Use App\Http\Controllers\RequestController;

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
    return view('component.content');
});

Route::resource('barang', BarangController::Class);
Route::resource('proyek', ProjectController::Class);
Route::resource('tenagakerja', TenagaKerjaController::Class);
Route::resource('baranginout', ToolsInOutController::Class);
Route::resource('request', RequestController::Class);
// Route::get('/proyek/showketua', ProjectController::Class, 'showketua');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
