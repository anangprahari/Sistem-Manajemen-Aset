<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\Api\DropdownController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Produk API
// Route::get('products/', [ProductController::class, 'index'])->name('api.product.index');

// Dropdown API Routes - Sesuaikan dengan yang dipanggil di JavaScript
Route::get('kelompoks/{akun_id}', [DropdownController::class, 'getKelompok']);
Route::get('jenis/{kelompok_id}', [DropdownController::class, 'getJenis']);
Route::get('objeks/{jenis_id}', [DropdownController::class, 'getObjek']);
Route::get('rincian-objeks/{objek_id}', [DropdownController::class, 'getRincianObjek']);
Route::get('sub-rincian-objeks/{rincian_objek_id}', [DropdownController::class, 'getSubRincianObjek']);
Route::get('sub-sub-rincian-objeks/{sub_rincian_objek_id}', [DropdownController::class, 'getSubSubRincianObjek']);

// Dropdown dengan prefix (untuk kompatibilitas)
Route::prefix('dropdown')->group(function () {
    Route::get('kelompoks/{akun_id}', [DropdownController::class, 'getKelompok']);
    Route::get('jenis/{kelompok_id}', [DropdownController::class, 'getJenis']);
    Route::get('objeks/{jenis_id}', [DropdownController::class, 'getObjek']);
    Route::get('rincian-objeks/{objek_id}', [DropdownController::class, 'getRincianObjek']);
    Route::get('sub-rincian-objeks/{rincian_objek_id}', [DropdownController::class, 'getSubRincianObjek']);
    Route::get('sub-sub-rincian-objeks/{sub_rincian_objek_id}', [DropdownController::class, 'getSubSubRincianObjek']);
    Route::post('generate-kode-barang', [DropdownController::class, 'generateKodeBarang']);
    Route::get('full-hierarchy', [DropdownController::class, 'getFullHierarchy']);
    Route::get('health-check', [DropdownController::class, 'healthCheck']);

    // Tambahkan di bagian akhir file api.php
    Route::get('dropdown/test-data', [DropdownController::class, 'testData']);
});