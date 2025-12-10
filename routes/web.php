<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CatalogController;
use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryMovement;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $productsCount   = Product::count();
    $categoriesCount = Category::count();

    $lowStockCount = Product::whereNotNull('min_stock')
        ->whereColumn('quantity', '<=', 'min_stock')
        ->count();

    $movementsToday = InventoryMovement::whereDate('created_at', today())->count();

    $recentMovements = InventoryMovement::with(['product', 'user'])
        ->orderByDesc('created_at')
        ->take(5)
        ->get();

    $lowStockProducts = Product::with('category')
        ->whereNotNull('min_stock')
        ->whereColumn('quantity', '<=', 'min_stock')
        ->orderBy('quantity', 'asc')
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'productsCount',
        'categoriesCount',
        'lowStockCount',
        'movementsToday',
        'recentMovements',
        'lowStockProducts'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/scan/{sku}', [ScanController::class, 'showBySku'])
    ->name('scan.product');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/catalog', [CatalogController::class, 'index'])
        ->name('catalog.index');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])
        ->name('reports.export.excel');

    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])
        ->name('reports.export.pdf');

    Route::view('/help', 'help')->name('help.index');

    Route::middleware('admin')->group(function () {

        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');

        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');

        Route::get('/products/{product}/qr', [ProductController::class, 'downloadQr'])
            ->name('products.qr');

        Route::get('/users', [UserManagementController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UserManagementController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserManagementController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UserManagementController::class, 'update'])
            ->name('users.update');

        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])
            ->name('users.destroy');
    });

    Route::get('/movements', [InventoryMovementController::class, 'index'])
        ->name('movements.index');

    Route::get('/movements/create', [InventoryMovementController::class, 'create'])
        ->name('movements.create');

    Route::post('/movements', [InventoryMovementController::class, 'store'])
        ->name('movements.store');

    Route::get('/scan', [ScanController::class, 'index'])
        ->name('scan.index');

    Route::post('/scan/process', [ScanController::class, 'process'])
        ->name('scan.process');
});

require __DIR__ . '/auth.php';
