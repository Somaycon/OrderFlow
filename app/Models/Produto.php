<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    public const CREATED_AT = 'criado_em';
    public const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'preco',
        'estoque',
        'ativo',
    ];

    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }

    public function itensPedidos(): HasMany {
        return $this->hasMany(ItensPedido::class);
    }
}
