<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InventoryController;

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
    return view('index');
})->middleware(['auth']);

Route::get('/register-item', function () {
    return view('fifo.registitem');
})->middleware(['auth'])->name('registitem.create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/register-item/store', [ItemController::class, 'store'])->middleware(['auth'])->name('registitem.store');

Route::get('/all-item', [ItemController::class, 'index'])->middleware(['auth'])->name('allitem.show');

Route::get('/item/{id}', [ItemController::class, 'edit'])->middleware(['auth'])->name('registitem.edit');

Route::put('/item/{id}', [ItemController::class, 'update'])->middleware(['auth'])->name('registitem.update');

Route::delete('/item/{id}', [ItemController::class, 'destroy'])->middleware(['auth'])->name('registitem.delete');

Route::get('/inventory-in', [InventoryController::class, 'showItemList'])->middleware(['auth'])->name('inventoryin.create');

Route::get('/inventory-in/{id}', [InventoryController::class, 'showTargetedItemIn'])->middleware(['auth'])->name('targetedinventoryin.create');

Route::get('/inventory-detail/{id}', [InventoryController::class, 'editInventoryIn'])->middleware(['auth'])->name('inventoryin.edit');

Route::put('/inventory-detail/{id}', [InventoryController::class, 'updateInventoryin'])->middleware(['auth'])->name('inventoryin.update');

Route::delete('/inventory-detail/{id}', [InventoryController::class, 'destroyInventory'])->middleware(['auth'])->name('inventoryin.delete');

Route::post('/inventory-in/store', [InventoryController::class, 'inventoryIn'])->middleware(['auth'])->name('inventoryin.store');

Route::get('/inventory/{id}', [InventoryController::class, 'inventoryList'])->middleware(['auth'])->name('inventoryin.list');

Route::get('/inventory-out', [InventoryController::class, 'showOutItemList'])->middleware(['auth'])->name('inventoryout.create');

Route::get('/inventory-out/{id}', [InventoryController::class, 'showTargetedItemOut'])->middleware(['auth'])->name('targetedinventoryout.create');

Route::post('/inventory-out/store', [InventoryController::class, 'inventoryOut'])->middleware(['auth'])->name('inventoryout.store');

Route::get('/all-order', [InventoryController::class, 'orderList'])->middleware(['auth'])->name('orderlist.show');

Route::get('/order/{id}', [InventoryController::class, 'orderDetail'])->middleware(['auth'])->name('orderdetail.show');

Route::get('/scan-in', function () {
    return view('fifo.inventoryinscan');
})->name('targetedinventoryscan.in');

Route::get('/scan-out', function () {
    return view('fifo.inventoryoutscan');
})->name('targetedinventoryscan.out');

Route::get('/all-item/search', [InventoryController::class, 'searchItem'])->middleware(['auth'])->name('searchitem');

Route::get('/all-order/search', [InventoryController::class, 'searchOrder'])->middleware(['auth'])->name('searchorder');

require __DIR__.'/auth.php';
