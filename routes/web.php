<?php

use App\Http\Controllers\Admin\TaskController;
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
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('tasks/create', [TaskController::class, 'new'])->name('tasks.new');
Route::post('tasks/new', [TaskController::class, 'create'])->name('tasks.create');
Route::get('tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('tasks/edit/{id}', [TaskController::class, 'update'])->name('tasks.update');

Route::get('tasks/delete/{id}', [TaskController::class, 'detalhe'])->name('tasks.detalhe');
Route::delete('tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');


/* Route::get('/', function () {
    return view('welcome');
}); */

Route::fallback(function(){
    return view('404');
});
