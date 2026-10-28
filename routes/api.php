<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;


Route::group(["prefix"=> "/produtos"], function () {
    Route::get("/", [ProdutoController::class, "index"]);
    Route::get("/{id}", [ProdutoController::class, "show"]);
    Route::post("/", [ProdutoController::class, 'store']);
    Route::put("/{id}", [ProdutoController::class, 'update']);
    Route::patch("/{id}/preco", [ProdutoController::class, 'updatePreco']);
    Route::patch("/{id}/status", [ProdutoController::class, "updateStatus"]);
});

Route::group(["prefix"=> "/clientes"], function () {
    Route::get("/", [ClienteController::class,"index"]);
    Route::get("/{id}", [ClienteController::class,"show"]);
    Route::post("/", [ClienteController::class, "store"]);
    Route::put("/{id}", [ClienteController::class, "update"]);
    Route::patch("/{id}/ativo", [ClienteController::class, "ativo"]);
});