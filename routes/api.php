<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rotas de Produtos
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/produtos/search', [ProdutoController::class, 'search']); 
    Route::get('produtos', [ProdutoController::class, 'index']);
    Route::post('produtos', [ProdutoController::class, 'store']);
    Route::get('produtos/{id}', [ProdutoController::class, 'show']);
    Route::post('produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{id}', [ProdutoController::class, 'destroy']);
});


// Rotas de Categorias
Route::middleware('auth:sanctum')->group(function () {
    Route::get('categorias', [CategoriaController::class, 'index']);
    Route::post('categorias', [CategoriaController::class, 'store']);
    Route::get('categorias/{id}', [CategoriaController::class, 'show']);
    Route::put('categorias/{id}', [CategoriaController::class, 'update']);
    Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);
});

// Rota de Imagens
Route::get('storage/app/foto/{filename}', function ($filename) {
    $path = storage_path('app/foto/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    } else {
        abort(404);
    }
})->where('filename', '.*');