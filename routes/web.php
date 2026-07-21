<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\EvidenciaController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Control panel.
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('clients', ClientController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);
    Route::resource('providers', ProviderController::class);
    
    // Evidence routes
    Route::resource('evidences', EvidenceController::class);
    Route::post('evidences/{evidence}/toggle-status', [EvidenceController::class, 'toggleStatus'])->name('evidences.toggle-status');
    
    // Evidencias de terreno con IA
    Route::get('/evidencias', [EvidenciaController::class, 'index'])->name('evidencias.index');
    
    Route::get("changeproducturl", [ProductController::class, "changeproducturl"])->name("changeproducturl");
    Route::get("changeclienturl", [ClientController::class, "changeclienturl"])->name("changeclienturl");
    Route::get("changeorderurl", [OrderController::class, "changeorderurl"])->name("changeorderurl");
});
