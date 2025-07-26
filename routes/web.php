<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Order\DueOrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Order\OrderPendingController;
use App\Http\Controllers\Order\OrderCompleteController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Dashboards\DashboardController;
use App\Http\Controllers\Product\ProductExportController;
use App\Http\Controllers\Product\ProductImportController;
use App\Http\Controllers\Aset\AsetController;
use App\Http\Controllers\Aset\AsetLancarController;

// Debug Route
Route::get('php/', function () {
    return phpinfo();
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('/users', UserController::class);
    Route::put('/user/change-password/{username}', [UserController::class, 'updatePassword'])->name('users.updatePassword');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master Data
    Route::resource('/quotations', QuotationController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/units', UnitController::class);

    // Products
    Route::get('/products/import', [ProductImportController::class, 'create'])->name('products.import.view');
    Route::post('/products/import', [ProductImportController::class, 'store'])->name('products.import.store');
    Route::get('/products/export', [ProductExportController::class, 'create'])->name('products.export.store');
    Route::resource('/products', ProductController::class);

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/pending', OrderPendingController::class)->name('orders.pending');
    Route::get('/orders/complete', OrderCompleteController::class)->name('orders.complete');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/update/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('/orders/details/{order_id}/download', [OrderController::class, 'downloadInvoice'])->name('order.downloadInvoice');

    // Due Orders
    Route::get('/due/orders', [DueOrderController::class, 'index'])->name('due.index');
    Route::get('/due/order/view/{order}', [DueOrderController::class, 'show'])->name('due.show');
    Route::get('/due/order/edit/{order}', [DueOrderController::class, 'edit'])->name('due.edit');
    Route::put('/due/order/update/{order}', [DueOrderController::class, 'update'])->name('due.update');

    // Purchases
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('/purchases/{purchase}/edit', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.delete');

    // Purchase Reports
    Route::get('/purchases/approved', [PurchaseController::class, 'approvedPurchases'])->name('purchases.approvedPurchases');
    Route::get('/purchases/report', [PurchaseController::class, 'dailyPurchaseReport'])->name('purchases.dailyPurchaseReport');
    Route::get('/purchases/report/export', [PurchaseController::class, 'getPurchaseReport'])->name('purchases.getPurchaseReport');
    Route::post('/purchases/report/export', [PurchaseController::class, 'exportPurchaseReport'])->name('purchases.exportPurchaseReport');

    // =============================
    // ROUTES FOR ASET
    // =============================

    // Aset Tetap Routes
    Route::get('/asets/export', [AsetController::class, 'export'])->name('asets.export');
    Route::resource('asets', AsetController::class);
    Route::get('/asets/{id}/download-pdf', [AsetController::class, 'downloadPdf'])->name('asets.downloadPdf');

    // API Routes for AJAX calls - Group them for better organization
    Route::prefix('api/asets')->name('api.asets.')->group(function () {
        Route::get('/kelompoks/{akunId}', [AsetController::class, 'getKelompoks'])->name('kelompoks');
        Route::get('/jenis/{kelompokId}', [AsetController::class, 'getJenis'])->name('jenis');
        Route::get('/objeks/{jenisId}', [AsetController::class, 'getObjeks'])->name('objeks');
        Route::get('/rincian-objeks/{objekId}', [AsetController::class, 'getRincianObjeks'])->name('rincian-objeks');
        Route::get('/sub-rincian-objeks/{rincianObjekId}', [AsetController::class, 'getSubRincianObjeks'])->name('sub-rincian-objeks');
        Route::get('/sub-sub-rincian-objeks/{subRincianObjekId}', [AsetController::class, 'getSubSubRincianObjeks'])->name('sub-sub-rincian-objeks');
        Route::post('/generate-kode-preview', [AsetController::class, 'generateKodeBarangPreview'])->name('generate-kode-preview');
    });

    // =============================
    // ROUTES FOR ASET LANCAR
    // =============================

    // Aset Lancar Routes
    Route::resource('aset-lancar', AsetLancarController::class);

    // AJAX Routes untuk dropdown dinamis Aset Lancar
    Route::prefix('ajax/aset-lancar')->name('ajax.aset-lancar.')->group(function () {
        Route::get('/kelompok', [AsetLancarController::class, 'getKelompok'])->name('kelompok');
        Route::get('/jenis', [AsetLancarController::class, 'getJenis'])->name('jenis');
        Route::get('/objek', [AsetLancarController::class, 'getObjek'])->name('objek');
        Route::get('/nomor-rekening', [AsetLancarController::class, 'getNomorRekening'])->name('nomor-rekening');
        Route::get('/uraian', [AsetLancarController::class, 'getUraian'])->name('uraian');
    });
});

// Auth routes
require __DIR__ . '/auth.php';

// Test route
Route::get('test/', function () {
    return view('orders.create');
});
