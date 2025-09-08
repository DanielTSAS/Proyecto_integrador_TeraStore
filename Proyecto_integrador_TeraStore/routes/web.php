<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
|
*/

// == RUTAS PÚBLICAS (Cualquier visitante puede verlas) ==
// Página de inicio
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Catálogo de productos
Route::get('/tienda', [App\Http\Controllers\ProductoController::class, 'index'])->name('tienda.index');
// Ver un producto específico
Route::get('/producto/{producto}', [App\Http\Controllers\ProductoController::class, 'show'])->name('tienda.show');


// == RUTAS DE AUTENTICACIÓN (Login, Registro, etc.) ==
// Para esto, te recomiendo instalar Laravel Breeze, que las crea automáticamente.
// Las rutas que Breeze crearía son:
// Route::get('/login', ...)->name('login');
// Route::post('/login', ...);
// Route::get('/register', ...)->name('register');
// Route::post('/register', ...);


// == RUTAS PRIVADAS (Solo para usuarios que han iniciado sesión) ==
Route::middleware(['auth'])->group(function () {
    // Carrito de Compras
    Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{producto}', [App\Http\Controllers\CarritoController::class, 'add'])->name('carrito.add');
    Route::delete('/carrito/remover/{producto}', [App\Http\Controllers\CarritoController::class, 'remove'])->name('carrito.remove');

    // Proceso de Compra (Checkout)
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/pedido-confirmado/{transaccion}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

    // Perfil del Usuario
    Route::get('/mi-cuenta', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil.index');
    Route::get('/mi-cuenta/pedidos', [App\Http\Controllers\PerfilController::class, 'pedidos'])->name('perfil.pedidos');

    // Cerrar sesión
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


// == RUTAS DE ADMINISTRADOR (Protegidas) ==
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard principal del admin
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas para gestionar Productos (Crear, Leer, Actualizar, Borrar)
    Route::resource('productos', App\Http\Controllers\Admin\ProductoController::class);
    
    // Rutas para gestionar Categorías
    Route::resource('categorias', App\Http\Controllers\Admin\CategoriaController::class);
});

// Esta línea es necesaria para que las rutas de autenticación de Breeze funcionen
// require __DIR__.'/auth.php';