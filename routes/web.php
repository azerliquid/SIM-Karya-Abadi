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
    
    // $user = Hash::make("admin");
    // return response()->json($user);
    // dd($user);
    if (Auth::check()) {
        
        if (Auth::user()->role == 'admin') {
            return redirect('/barang');
        }elseif (Auth::user()->role == 'logistic') {
            return redirect('/barang');
        }elseif (Auth::user()->role == 'hr') {
            return redirect('/proyek');
        }elseif (Auth::user()->role == 'mandor') {
            return redirect('/request');
        }
    }else {
        return view('auth.login');
    }
});

// Route::fallback(function(){
//     return redirect('/');
// });

// Route::get('/proyek/showketua', ProjectController::Class, 'showketua');
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     // dd();
//     return view('dashboard');
// })->name('dashboard');


Route::get('/tenagakerja', [TenagaKerjaController::Class, 'index']);
Route::post('/tenagakerja', [TenagaKerjaController::Class, 'store']);

Route::group(['middleware' => ['auth:sanctum', 'checkRole:admin']], function()
{
    Route::get('/barang', [BarangController::Class, 'index']);
    Route::post('/barang', [BarangController::Class, 'store']);
    Route::put('/barang/{id}', [BarangController::Class, 'update']);
    Route::delete('/barang/{id}', [BarangController::Class, 'destroy']);
    Route::get('/tenagakerja', [TenagaKerjaController::Class, 'index']);
    Route::post('/tenagakerja', [TenagaKerjaController::Class, 'store']);
    Route::put('/tenagakerja/{id}', [TenagaKerjaController::Class, 'update']);
    Route::delete('/tenagakerja/{id}', [TenagaKerjaController::Class, 'destroy']);
    Route::get('/tenagakerja/show/{id}', [TenagaKerjaController::Class, 'show']);
    Route::get('/proyek', [ProjectController::Class, 'index']);
    Route::get('/proyek/create', [ProjectController::Class, 'create']);
    Route::post('/proyek/', [ProjectController::Class, 'store']);
    Route::put('/proyek/{id}', [ProjectController::Class, 'update']);
    Route::delete('/proyek/{id}', [ProjectController::Class, 'destroy']);
    // Route::resource('tenagakerja', TenagaKerjaController::Class);
    Route::resource('baranginout', ToolsInOutController::Class);
    Route::resource('request', RequestController::Class);

});

// Route::group(['middleware' => ['auth:sanctum', 'checkRole:logistic']], function()
// {
//     // Route::resource('barang', BarangController::Class);  
//     Route::resource('baranginout', ToolsInOutController::Class);
//     Route::resource('request', RequestController::Class);

// });

// Route::group(['middleware' => ['auth:sanctum', 'checkRole:hr']], function()
// {
//     Route::resource('proyek', ProjectController::Class);
//     Route::resource('tenagakerja', TenagaKerjaController::Class);
// });

Route::group(['middleware' => ['auth:sanctum', 'checkRole:mandor']], function()
{
    // Route::resource('baranginout', ToolsInOutController::Class);
    Route::get('/request', [RequestController::Class, 'showForm']);
    Route::get('/request', [RequestController::Class, 'index']);
    Route::get('/request/create', [RequestController::Class, 'create']);
    Route::post('/request/store', [RequestController::Class, 'store']);
    Route::get('/historyrequest', [RequestController::Class, 'index']);
    Route::get('/historyrequest/{type}', [RequestController::Class, 'showData']);
    Route::get('/listitem/{id}', [RequestController::Class, 'getListItem']);
});

// Route::get('/', function ()
// {
//     return redirect('/dashboard');
// });
