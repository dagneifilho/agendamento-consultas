<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable=[
        'nome',
        'crm'
    ];
    public function especialidades() {
        return $this->belongsToMany(Especialidade::class, 'medicos_especialidades')->withTimestamps();
    }
    public function consultas() {
        return $this->hasMany(Consulta::class);
    }
}
