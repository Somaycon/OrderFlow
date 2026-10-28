<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();
        if ($request->has('ativo')) {
            $dados = $request->validate([
                'ativo' => 'required|boolean',
            ]);

            $query->where('ativo', $dados['ativo']);
        }
        $clientes = $query->paginate(10);
        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    public function store (Request $request){
        $request->merge(['email' => strtolower(trim($request->input('email')))]);

        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'email' => 'required|email|max:255|unique:clientes,email',
            'telefone' => 'nullable|string|max:20',
            'ativo' => 'sometimes|boolean',
        ],
        [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode ter mais de 150 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de 255 caracteres.',
            'email.unique' => 'O email informado já está em uso.',
            'telefone.string' => 'O campo telefone deve ser uma string.',
            'telefone.max' => 'O campo telefone não pode ter mais de 20 caracteres.',
            'ativo.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
        ]);

        $cliente = Cliente::create($dados);

        return response()->json($cliente, 201);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        
        if ($request->has('email')) {
            $request->merge(['email' => strtolower(trim($request->input('email')))]);
        }

        $dados = $request->validate([
            'nome' => 'sometimes|required|string|max:150',
            'email' => ['sometimes', 'required', 'email', 'max:255', Rule::unique('clientes', 'email')->ignore($cliente->id)],
            'telefone' => 'nullable|string|max:20',
            'ativo' => 'sometimes|boolean',
        ]);

        $cliente->update($dados);
        return response()->json($cliente);
    }

    public function ativo(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->ativo = !$cliente->ativo;
        $cliente->save();

        if ($cliente->ativo) {
            return response()->json(['message' => 'Cliente ativado com sucesso.']);
        } else {
            return response()->json(['message' => 'Cliente desativado com sucesso.']);
        }
    }
}
