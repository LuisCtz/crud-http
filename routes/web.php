<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

// Ruta principal — lista de productos (GET)
Route::get('/', [ProductoController::class, 'index'])->name('productos.index');

// Mostrar formulario de crear (GET)
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');

// Guardar producto nuevo (POST)
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

// Mostrar formulario de editar (GET)
Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');

// Actualizar producto (PUT)
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');

// Eliminar producto (DELETE)
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
