<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'cpf',
        'dataNascimento',
        'email',
        'cep',
        'endereco',
        'numero',
        'nome_responsavel',
        'cpf_responsavel'
    ];

    public function telefones() {
        return $this->hasMany(Telefone::class);
    }
    public function consultas() {
        return $this->hasMany(Consulta::class);
    }
}
