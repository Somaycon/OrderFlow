<?php

use App\Http\Controllers\ProdutoController;


Route::group(["prefix"=> "/produtos"], function () {
    Route::get("/", [ProdutoController::class, "index"]);
    Route::get("/{id}", [ProdutoController::class, "show"]);
    Route::post("/", [ProdutoController::class, 'store']);
    Route::put("/{id}", [ProdutoController::class, 'update']);
    Route::patch("/{id}/preco", [ProdutoController::class, 'updatePreco']);
    Route::patch("/{id}/status", [ProdutoController::class, "updateStatus"]);
});