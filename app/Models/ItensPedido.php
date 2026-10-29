<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItensPedido extends Model
{
    protected $table = "itens_pedidos";
    public const CREATED_AT = 'criado_em';
    public const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'nome_produto',
        'quantidade',
        'preco_unitario',
    ];

    protected function casts(): array
    {
        return [
            'nome_produto' => 'string',
            'quantidade' => 'integer',
            'preco_unitario' => 'decimal:2',
        ];
    }
    
    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
