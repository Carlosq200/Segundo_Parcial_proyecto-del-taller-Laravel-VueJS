<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;

// Diagnóstico rápido
Route::get("/ping", fn() => response()->json(["ok" => true]));

// Login central (SIN middleware tenant)
Route::post("/login", [AuthController::class, "login"]);

// Rutas protegidas por tenant + sanctum
Route::middleware(["tenant", "auth:sanctum"])->group(function () {
    Route::apiResource("clientes", ClienteController::class);
    Route::post("/logout", [AuthController::class, "logout"]);
});