<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas rutas
| son cargadas por el RouteServiceProvider dentro de un grupo que contiene
| el middleware "web". Ahora, crea algo grandioso!
|
*/

// Ruta principal que muestra la página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Ruta del dashboard, protegida por los middleware 'auth' y 'verified'
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grupo de rutas protegidas por el middleware 'auth'
Route::middleware('auth')->group(function () {
    
    /**
     * Rutas de Perfil de Usuario
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Rutas de Artículos (CRUD Completo)
     */
    Route::resource('articles', ArticleController::class);

    /**
     * Rutas de Categorías (CRUD Completo)
     */
    Route::resource('categories', CategoryController::class);

    /**
     * Rutas de Mensajes de Contacto
     * 
     * Si deseas manejar mensajes de contacto a través de vistas web, puedes agregar
     * las rutas correspondientes aquí. Asegúrate de que `ContactMessageController`
     * tenga los métodos `create` y `store`.
     */

});

/**
 * Inclusión de Rutas de Autenticación de Laravel Breeze
 * 
 * Estas rutas manejan el registro, inicio de sesión, recuperación de contraseña,
 * verificación de correo electrónico, etc.
 */
require __DIR__.'/auth.php';
