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

Route::get('/dashboard', function () {
    // return response()->json( Auth::user());
    if (Auth::user()->role == 'admin') {
        return redirect('barang');
    }elseif (Auth::user()->role == 'logistic') {
        return redirect('barang');
    }elseif (Auth::user()->role == 'hr') {
        return redirect('proyek');
    }elseif (Auth::user()->role == 'mandor') {
        return redirect('request');
    }
});

// Route::get('/proyek/showketua', ProjectController::Class, 'showketua');
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     // dd();
//     return view('dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'checkRole:admin']], function()
{
    Route::resource('barang', BarangController::Class);
    Route::resource('proyek', ProjectController::Class);
    Route::resource('tenagakerja', TenagaKerjaController::Class);
    Route::resource('baranginout', ToolsInOutController::Class);
    Route::resource('request', RequestController::Class);

});

Route::group(['middleware' => ['auth:sanctum', 'checkRole:logistic']], function()
{
    Route::resource('barang', BarangController::Class);
    Route::resource('baranginout', ToolsInOutController::Class);
    Route::resource('request', RequestController::Class);

});

Route::group(['middleware' => ['auth:sanctum', 'checkRole:hr']], function()
{
    Route::resource('proyek', ProjectController::Class);
    Route::resource('tenagakerja', TenagaKerjaController::Class);
});

Route::group(['middleware' => ['auth:sanctum', 'checkRole:mandor']], function()
{
    Route::resource('baranginout', ToolsInOutController::Class);
    Route::resource('request', RequestController::Class);
});

Route::get('/', function ()
{
    return redirect('/dashboard');
});
