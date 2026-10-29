<?php

namespace App\Http\Controllers;

use App\Models\ItensPedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class ItensPedidoController extends Controller
{
public function store(Request $request)
    {
        $dados = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            ]);

            $produto = Produto::findOrFail($dados['produto_id']);
            $dados['nome_produto'] = $produto->nome;
            $dados['preco_unitario'] = $produto->preco;

        $itemPedido = ItensPedido::create($dados);
        return response()->json($itemPedido, 201);
    }
}
