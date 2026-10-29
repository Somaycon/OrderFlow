<?php

namespace App\Http\Controllers;

use App\Enums\StatusPedido;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PedidoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Pedido::query()->with('cliente')->latest('criado_em');

        if ($request->has("status")) {
            $dados = $request->validate([
                'status' => ['required', Rule::enum(StatusPedido::class)],
            ]);

            $query->where('status', $dados['status']);
        }
        $pedidos = $query->paginate(10);
        return response()->json($pedidos);
    }
}
