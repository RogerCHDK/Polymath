<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Models\Empleado;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::apiResource('empresa', EmpresaController::class);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('empleado', EmpleadoController::class);
});
