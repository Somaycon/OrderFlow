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
        $dados = $request->validate([
            'status' => ['sometimes', Rule::enum(StatusPedido::class)],
            'cliente' => ['sometimes', 'integer', 'exists:clientes,id'],
        ]);

        $query = Pedido::query()->with('cliente')->latest('criado_em');

        if (isset($dados['status'])) {
            $query->where('status', $dados['status']);
        }

        if (isset($dados['cliente'])) {
            $query->where('cliente_id', $dados['cliente']);
        }

        $pedidos = $query->paginate(10);
        return response()->json($pedidos);
    }

    public function show(int $id): JsonResponse
    {
        $pedido = Pedido::with(['cliente', 'itensPedidos.produto'])->findOrFail($id);
        return response()->json($pedido);
    }

    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'status' => [Rule::enum(StatusPedido::class)],
        ]);
        if (!isset($dados['status'])) {
            $dados['status'] = StatusPedido::PENDENTE;
        }
        $pedido = Pedido::create($dados);
        return response()->json($pedido, 201);
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $pedido = Pedido::findOrFail($id);

        $dados = $request->validate([
            'status' => ['required', Rule::enum(StatusPedido::class)],
        ]);
        $pedido->update($dados);
        return response()->json($pedido);
    }
}
