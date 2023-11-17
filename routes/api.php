<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->group(function () {
//Route untuk menampilkan semua emplloyess
Route::get('/employees', [EmployeesController::class, "index"]);

//Route untuk menambahkan data employess
Route::post('/employees', [EmployeesController::class, "store"]);

//Route untuk mengedit data employess
Route::put('/employees/{id}', [EmployeesController::class, "update"]);

//Route untuk menghapus data employess
Route::delete('/employees/{id}', [EmployeesController::class, "destroy"]);

//Route untuk get detail employesss
Route::get('/employees/{id}', [EmployeesController::class, "show"]);

//Route untuk search name employess
Route::get('/employees/search/{name}', [EmployeesController::class, "seacrh"]);

//Route untuk active 
Route::get('/employees/status/active', [EmployeesController::class, "active"]);

//Route untuk inactive 
Route::get('/employees/status/inactive', [EmployeesController::class, "inactive"]);

//ROute untuk terminated
Route::get('/employees/status/terminated', [EmployeesController::class, "terminated"]);
});

//Route login dan register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);