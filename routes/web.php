<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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
});

Route::resource('posts', PostController::class);

Route::get('/register-item', function () {
    return view('fifo.registitem');
})->name('registitem.create');

Route::post('/register-item/store', [ItemController::class, 'store'])->name('registitem.store');

Route::get('/all-item', [ItemController::class, 'index'])->name('allitem.show');

Route::get('/item/{id}', [ItemController::class, 'edit'])->name('registitem.edit');

Route::put('/item/{id}', [ItemController::class, 'update'])->name('registitem.update');

Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('registitem.delete');

Route::get('/inventory-in', [InventoryController::class, 'showItemList'])->name('inventoryin.create');

Route::post('/inventory-in/store', [InventoryController::class, 'inventoryIn'])->name('inventoryin.store');

Route::get('/inventory/{id}', [InventoryController::class, 'inventoryList'])->name('inventoryin.list');

Route::get('/inventory-out', [InventoryController::class, 'showOutItemList'])->name('inventoryout.create');

Route::post('/inventory-out/store', [InventoryController::class, 'inventoryOut'])->name('inventoryout.store');

Route::get('/all-order', [InventoryController::class, 'orderList'])->name('orderlist.show');

Route::get('/order/{id}', [InventoryController::class, 'orderDetail'])->name('orderdetail.show');