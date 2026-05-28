<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockAdjustmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('medicines', MedicineController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('stock-adjustments', StockAdjustmentController::class);
    Route::resource('prescriptions', PrescriptionController::class);

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/',                [ReportController::class, 'index'])->name('index');
    Route::get('/monthly-sales',   [ReportController::class, 'monthlySales'])->name('monthly-sales');
    Route::get('/top-medicines',   [ReportController::class, 'topMedicines'])->name('top-medicines');
    Route::get('/category-revenue',[ReportController::class, 'categoryRevenue'])->name('category-revenue');
    Route::get('/stock',           [ReportController::class, 'stockReport'])->name('stock');
    Route::get('/suppliers',       [ReportController::class, 'supplierReport'])->name('suppliers');
});

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';