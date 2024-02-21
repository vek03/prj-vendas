<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ItemVendaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});



//FALLBACK
Route::fallback(function () {
    return view('dashboard');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



//Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//Cliente
Route::middleware('auth')->group(function () {
    Route::get('/client', [ClienteController::class, 'create'])->name('client.create');
    Route::post('/client', [ClienteController::class, 'store'])->name('client.store');
    Route::delete('/client/{client}', [ClienteController::class, 'destroy'])->name('client.destroy');
});



//Produtos
Route::middleware('auth')->group(function () {
    Route::get('/product-create', [ProdutoController::class, 'create'])->name('product.create');
    Route::post('/product-create', [ProdutoController::class, 'store'])->name('product.store');
    Route::delete('/product-delete/{product}', [ProdutoController::class, 'destroy'])->name('product.destroy');
});



//Vendas
Route::middleware('auth')->group(function () {
    Route::get('/sale-create', [VendaController::class, 'create'])->name('sale.create');
    Route::post('/sale-create', [VendaController::class, 'store'])->name('sale.store');

    Route::get('/sale-edit/{sale}', [VendaController::class, 'edit'])->name('sale.edit');
    Route::patch('/sale-edit/{sale}', [VendaController::class, 'update'])->name('sale.update');

    Route::delete('/sale-delete/{sale}', [VendaController::class, 'destroy'])->name('sale.destroy');

    Route::get('/gerar-pdf-vendas', [VendaController::class, 'gerarPdf'])->name('sale.gerar-pdf');
});



//Item_Vendas
Route::middleware('auth')->group(function () {
    Route::get('/item/{sale}', [ItemVendaController::class, 'list'])->name('item.list');
});

require __DIR__.'/auth.php';
