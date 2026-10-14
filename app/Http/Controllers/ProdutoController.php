<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(): JsonResponse
    {
        $produtos = Produto::paginate(10);
        return response()->json($produtos);
    }

    public function show(int $id): JsonResponse{
        $produto = Produto::findOrFail($id);
        return response()->json($produto);
    }
    public function store(Request $request): JsonResponse 
    {
        $dados = $request->validate([
            'categoria_id' => 'required|integer|exists:categorias,id',
            'nome' => 'required|string|max:150',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|gt:0',
            'estoque' => 'required|integer|min:0',
            'ativo' => 'sometimes|boolean',
        ]);

        $produto = Produto::create($dados);
        return response()->json($produto);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $produto = Produto::findOrFail($id);

        $dados = $request->validate([
            'categoria_id' => 'sometimes|integer|exists:categorias,id',
            'nome' => 'sometimes|string|max:150',
            'descricao' => 'sometimes|nullable|string',
            'preco' => 'sometimes|numeric|gt:0',
            'estoque' => 'sometimes|integer|min:0',
            'ativo' => 'sometimes|boolean',
        ]);

        $produto->update($dados);
        return response()->json($produto);
    }

    public function updatePreco(Request $request, int $id): JsonResponse{
        $produto = Produto::findOrFail($id);
        $dados = $request->validate([
            'preco' => 'required|numeric|gt:0',
        ]);

        $produto->update($dados);
        return response()->json($produto);
    }
}
