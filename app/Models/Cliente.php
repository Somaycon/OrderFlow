<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    public const CREATED_AT = 'criado_em';
    public const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'ativo',
    ];

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}
