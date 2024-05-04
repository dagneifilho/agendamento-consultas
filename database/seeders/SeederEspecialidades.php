<?php

namespace Database\Seeders;

use App\Models\Especialidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederEspecialidades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $especialidades = [
            'Pediatria',
            'Ortopedia',
            'Clinica Geral',
            'Cardiologia',
            'Psiquiatria'
        ];
        foreach($especialidades as $especialidade) {
            Especialidade::create(['nome'=>$especialidade]);
        }

    }
}
