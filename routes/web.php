<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\TaskController;

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

Route::middleware(['auth'])->group(function(){
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'new'])->name('tasks.new');
    Route::post('tasks/new', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/edit/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('tasks/delete/{id}', [TaskController::class, 'detalhe'])->name('tasks.detalhe');
    Route::delete('tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');

});





Route::post('user/signup', [UserController::class, 'signup'])->name('user.signup');
    /* Route::get('user/sigin', [UserController::class, 'sigin'])->name('user.sigin'); */
Route::post('user/auth', [UserController::class, 'auth'])->name('user.auth');
Route::get('user/login', [UserController::class, 'login'])->name('user.login');
Route::get('user/register', [UserController::class, 'register'])->name('user.register');

Route::get('/', function () {
    return view('user.login');
});

Route::fallback(function(){
    return view('404');
});
