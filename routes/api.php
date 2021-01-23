<?php

use App\Http\Controllers\Api\TodoController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/todos",[TodoController::class ,"index"] );
Route::get("/todo/{id}",[TodoController::class ,"show"]);
Route::post("/todos",[TodoController::class ,"create"]);
Route::put("/todos/{id}",[TodoController::class ,"update"]);
Route::patch("/todos/{id}",[TodoController::class ,"updateCompleted"]);
Route::delete("/todos/{id}",[TodoController::class ,"destroy"]);
