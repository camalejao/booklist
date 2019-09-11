<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'autor_id', 'titulo', 'descricao', 'categoria', 'status', 'avaliacao',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }
}
