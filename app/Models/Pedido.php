<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\StatusPedido;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    public const CREATED_AT = 'criado_em';
    public const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'cliente_id',
        'status',
    ];

    protected function casts (): array
    {
        return [
            'status' => StatusPedido::class,
        ];
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itensPedidos(): HasMany
    {
        return $this->hasMany(ItensPedido::class);
    }
}
