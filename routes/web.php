<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */
Route::get('/', [UserController::class, 'register']);


// função que renderiza o todo
 Route::get('/login', function () {
    return Inertia::render("Login/Login");
});


Route::get('user/login', [UserController::class, 'login'])->name('user.login');
Route::get('user/register', [UserController::class, 'register'])->name('user.register');
Route::post('user/auth', [UserController::class, 'auth'])->name('user.auth');
require __DIR__.'/auth.php';
