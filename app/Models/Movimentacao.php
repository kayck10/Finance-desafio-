<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;
    protected $table = 'movimentacoes';
    protected $fillable = ['descricao', 'valor', 'data', 'categoria_id', 'tipo_id',];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoMovimentacao::class, 'tipo_id');
    }
}

