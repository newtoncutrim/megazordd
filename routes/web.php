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


Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function(){
    return view('404');
});
