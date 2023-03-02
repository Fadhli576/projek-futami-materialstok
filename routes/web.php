<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UpdateStokController;
use App\Http\Controllers\UserController;

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
    return view('home.index');
});

Route::get('/scanner', function () {
    return view('home.scanner');
});

Route::middleware('Guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login-page');
    Route::post('/login', [LoginController::class, 'authanticate'])->name('login.auth');
});

Route::middleware(['Login', 'checkRole:super admin'])->group(function () {
    Route::get('/dashboard/user-data', [MaterialController::class, 'indexUser'])->name('user-index');
    Route::post('/dashboard/user-store', [MaterialController::class, 'storeUser'])->name('user-store');
    Route::delete('/dashboard/user-delete/{id}', [MaterialController::class, 'destroyUser'])->name('delete-user');
    Route::get('/register', [RegisterController::class, 'index'])->name('register-page');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
    Route::get('/dashboard/edit-user/{id}', [MaterialController::class, 'editUser'])->name('edit-user');
    Route::put('/dashboard/update-user/{id}', [MaterialController::class, 'updateUser'])->name('update-user');
});

Route::middleware('Login')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/dashboard', [MaterialController::class, 'indexDashboard'])->name('index-dashboard');
    Route::get('/dashboard/material-data', [MaterialController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard/edit-material/{no_material}', [MaterialController::class, 'edit'])->name('edit-material');
    Route::put('/dashboard/update-material/{no_material}', [MaterialController::class, 'update'])->name('update-material');
    Route::get('/dashboard/view-material/{no_material}', [MaterialController::class, 'searchMaterial'])->name('search-material');
    Route::post('/dashboard/view-material', [MaterialController::class, 'searchMaterialPost'])->name('search-material-post');

    Route::get('/dashboard/update-stok/{no_material}', [UpdateStokController::class, 'edit'])->name('update-stok');
    Route::put('/dashboard/update-stok-proses/{no_material}', [UpdateStokController::class, 'update'])->name('update-stoki');
    Route::get('/dashboard/scan-langsung', [MaterialController::class, 'scanLangsungView'])->name('scan-langsung-view');
    Route::post('/dashboard/scan-langsung/post', [MaterialController::class, 'scanLangsung'])->name('scan-langsung');

    Route::get('/dashboard/scan-manual', [MaterialController::class, 'scanManualView'])->name('scan-manual-view');

    Route::get('/dashboard/profile', [UserController::class, 'index'])->name('profile-index');
    Route::put('/dashboard/update-profile', [UserController::class, 'update'])->name('update-profile');

    Route::get('/dashboard/edit-password', [UserController::class, 'edit'])->name('edit-password');
    Route::put('/dashboard/update-password', [UserController::class, 'passwordUpdate'])->name('update-password');

});

Route::middleware(['Login', 'checkRole:super admin,admin'])->group(function () {
    Route::post('/store', [MaterialController::class, 'store'])->name('dashboard.store');
    Route::delete('/dashboard/delete-material/{material}', [MaterialController::class, 'destroy'])->name('delete-material');
    Route::get('/dashboard/material-export', [MaterialController::class, 'materialExport'])->name('material-export');
    Route::get('/dashboard/update-stok-export', [MaterialController::class, 'updateStokExport'])->name('update-stok-export');
    Route::get('/dashboard/print', [MaterialController::class, 'printMaterial'])->name('print-material');
    Route::get('/dashboard/stok-langsung', [MaterialController::class, 'indexDashboardLangsung'])->name('dashboard-langsung');

    Route::get('/dashboard/satuan-data', [SatuanController::class, 'index'])->name('satuan-index');
    Route::post('/dashboard/satuan-store', [SatuanController::class, 'store'])->name('satuan-store');
    Route::get('/dashboard/edit-satuan/{satuan}', [SatuanController::class, 'edit'])->name('satuan-edit');
    Route::put('/dashboard/update-satuan/{satuan}', [SatuanController::class, 'update'])->name('satuan-update');
    Route::delete('/dashboard/delete-satuan/{satuan}', [SatuanController::class, 'destroy'])->name('satuan-delete');

    Route::put('/dashboard/tambah-keterangan/{id}', [MaterialController::class, 'tambahKeterangan'])->name('tambah-keterangan');
});










