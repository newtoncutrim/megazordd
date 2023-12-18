<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\Auth\UserAuthApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Neste exemplo, assumindo que você tenha um controlador chamado TaskController, as rotas serão definidas da seguinte forma:

Index: GET /api/tasks - Exibe uma lista de recursos (tarefas).
Create: GET /api/tasks/create - Exibe o formulário para criar um novo recurso (tarefa).
Store: POST /api/tasks - Armazena um novo recurso (tarefa) no banco de dados.
Show: GET /api/tasks/{id} - Exibe um recurso específico (tarefa).
Edit: GET /api/tasks/{id}/edit - Exibe o formulário para editar um recurso existente (tarefa).
Update: PUT/PATCH /api/tasks/{id} - Atualiza um recurso existente (tarefa) no banco de dados.
Destroy: DELETE /api/tasks/{id} - Remove um recurso existente (tarefa) do banco de dados.
*/


Route::middleware('auth:sanctum')->group(function () {
    // Route for retrieving the authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/tasks', TaskApiController::class);
});

// Route::get('users/check-email/{email}', [UserApiController::class, 'checkEmail']);


Route::apiResource('/tasks', TaskApiController::class)->middleware('auth:sanctum');

Route::post('auth/login', [UserAuthApiController::class, 'login']);
Route::apiResource('/users', UserApiController::class);

/* tokem jwt api */
/* http://localhost:8989/api/auth/login */
