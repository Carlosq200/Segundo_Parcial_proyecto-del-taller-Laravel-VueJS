<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;

Route::post("/login", [AuthController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::apiResource("clientes", ClienteController::class);
    Route::post("/logout", [AuthController::class, "logout"]);
});

// diagnóstico
Route::get("/ping", fn() => response()->json(["ok"=>true]));