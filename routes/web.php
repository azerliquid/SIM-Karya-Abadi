<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\BarangController;
Use App\Http\Controllers\ProjectController;
Use App\Http\Controllers\TenagaKerjaController;
Use App\Http\Controllers\ToolsInOutController;
Use App\Http\Controllers\BarangInOutController;
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
    // session_destroy();
    // Auth::logout();
    // dd(Auth::user());
    // session_destroy();

    
    // $user = Hash::make("admin");
    // return response()->json(Auth::user());
    // dd($user);
    if (Auth::check()) {
        // return Response::json(Auth::user()->role);
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/listbarang');
        }elseif (Auth::user()->role == 'logistic') {
            return redirect('/logistik/barang');
        }elseif (Auth::user()->role == 'hr') {
            return redirect('/hr/proyek');
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


// Route::get('/tenagakerja', [TenagaKerjaController::Class, 'index']);
// Route::post('/tenagakerja', [TenagaKerjaController::Class, 'store']);

Route::group(['middleware' => ['auth:sanctum', 'checkRole:admin']], function()
{
    Route::get('/admin/listbarang', [BarangController::Class, 'index']);
    Route::post('/admin/listbarang', [BarangController::Class, 'store']);
    Route::put('/admin/listbarang/{id}', [BarangController::Class, 'update']);
    Route::delete('/admin/listbarang/{id}', [BarangController::Class, 'destroy']);
    Route::get('/admin/showdetailbarang/{id}', [BarangController::Class, 'showDetail']);
    Route::get('/admin/detailbarang/{id}/{start}/{end}/{tp}', [BarangController::Class, 'detailBarang']);

    Route::get('/admin/listtenagakerja', [TenagaKerjaController::Class, 'index']);
    Route::post('/admin/listtenagakerja', [TenagaKerjaController::Class, 'store']);
    Route::put('/admin/listtenagakerja/{id}', [TenagaKerjaController::Class, 'update']);
    Route::delete('/admin/listtenagakerja/{id}', [TenagaKerjaController::Class, 'destroy']);
    Route::get('/admin/listtenagakerja/show/{id}', [TenagaKerjaController::Class, 'show']);

    Route::get('/admin/listproyek', [ProjectController::Class, 'index']);
    Route::get('/admin/listproyek/create', [ProjectController::Class, 'create']);
    Route::post('/admin/listproyek', [ProjectController::Class, 'store']);
    Route::put('/admin/listproyek/{id}', [ProjectController::Class, 'update']);
    Route::delete('/admin/listproyek/{id}', [ProjectController::Class, 'destroy']);
    Route::get('/admin/proyek/show/{id}', [ProjectController::Class, 'show']);
    Route::put('/admin/proyek/detail/{id}/{start}/{end}', [ProjectController::Class, 'detail']);
    Route::put('/admin/proyek/alocated/{id}/{start}/{end}', [ProjectController::Class, 'sumBarang']);
    // Route::resource('tenagakerja', TenagaKerjaController::Class);
    // Route::resource('baranginout', ToolsInOutController::Class);
    Route::get('/listbaranginout', [BarangInOutController::Class, 'index']);
    Route::post('/listbaranginout/{type}/{start}/{end}', [BarangInOutController::Class, 'showData']);
    Route::get('/listbaranginout/create', [BarangInOutController::Class, 'create']);
    Route::post('/listbaranginoutadd', [BarangInOutController::Class, 'store']);

});

Route::group(['middleware' => ['auth:sanctum', 'checkRole:logistic']], function()
{
    // Route::resource('barang', BarangController::Class);  
    Route::get('/logistik/barang', [BarangController::Class, 'index']);
    Route::post('/logistik/barang', [BarangController::Class, 'store']);
    Route::get('/logistik/showdetail/{id}', [BarangController::Class, 'showDetail']);
    Route::get('/logistik/detailbarang/{id}/{start}/{end}/{tp}', [BarangController::Class, 'detailBarang']);
    Route::put('/logistik/barang/{id}', [BarangController::Class, 'update']);
    Route::delete('/logistik/barang/{id}', [BarangController::Class, 'destroy']);

    Route::get('/logistik/baranginout', [BarangInOutController::Class, 'index']);
    Route::post('/logistik/baranginout/{type}/{start}/{end}', [BarangInOutController::Class, 'showData']);
    Route::get('/logistik/baranginout/create', [BarangInOutController::Class, 'create']);
    Route::post('/logistik/baranginoutadd', [BarangInOutController::Class, 'store']);
    
    Route::get('/logistik/listrequest', [RequestController::Class, 'index']);
    Route::post('/logistik/updaterequest', [RequestController::Class, 'saverequest']);
    // Route::get('/listrequest/create', [RequestController::Class, 'create']);
    Route::get('/logistik/listrequest/{type}', [RequestController::Class, 'showData']);
    Route::get('/logistik/listitemrequest/{id}', [RequestController::Class, 'getListItem']);

    
    Route::get('/logistik/proyek', [ProjectController::Class, 'index']);
    Route::get('/logistik/proyek/show/{id}', [ProjectController::Class, 'show']);
    Route::put('/logistik/proyek/detail/{id}/{start}/{end}', [ProjectController::Class, 'detail']);
    Route::put('/logistik/proyek/alocated/{id}/{start}/{end}', [ProjectController::Class, 'sumBarang']);

});

Route::group(['middleware' => ['auth:sanctum', 'checkRole:hr']], function()
{
    Route::get('/hr/proyek', [ProjectController::Class, 'index']);
    Route::get('/hr/proyek/create', [ProjectController::Class, 'create']);
    Route::post('/hr/proyek', [ProjectController::Class, 'store']);
    Route::put('/hr/proyek/{id}', [ProjectController::Class, 'update']);
    Route::get('/hr/proyek/show/{id}', [ProjectController::Class, 'show']);
    Route::put('/hr/proyek/detail/{id}/{start}/{end}', [ProjectController::Class, 'detail']);
    Route::put('/hr/proyek/alocated/{id}/{start}/{end}', [ProjectController::Class, 'sumBarang']);
    Route::delete('/hr/proyek/{id}', [ProjectController::Class, 'destroy']);
    // Route::resource('proyek', ProjectController::Class);
    Route::get('/hr/tenagakerja', [TenagaKerjaController::Class, 'index']);
    Route::post('/hr/tenagakerja', [TenagaKerjaController::Class, 'store']);
    Route::get('/hr/tenagakerja/show/{id}', [TenagaKerjaController::Class, 'show']);
    Route::put('/hr/tenagakerja/{id}', [TenagaKerjaController::Class, 'update']);
    Route::delete('/hr/tenagakerja/{id}', [TenagaKerjaController::Class, 'destroy']);
});

Route::group(['middleware' => ['auth:sanctum', 'checkRole:mandor']], function()
{
    // Route::resource('baranginout', ToolsInOutController::Class);
    Route::get('/request', [RequestController::Class, 'showForm']);
    Route::get('/request/create', [RequestController::Class, 'create']);
    Route::post('/request/store', [RequestController::Class, 'store']);
    Route::get('/confirmrequest/{id}', [RequestController::Class, 'setselesai']);
    Route::get('/historyrequest', [RequestController::Class, 'index']);
    Route::get('/historyrequest/{type}', [RequestController::Class, 'showData']);
    Route::get('/listitem/{id}', [RequestController::Class, 'getListItem']);
});

// Route::get('/', function ()
// {
//     return redirect('/dashboard');
// });
