<?php

namespace App\Services;

use App\Interfaces\EspecialidadesServiceInterface;
use App\Models\Especialidade;
use Illuminate\Pagination\LengthAwarePaginator;

class EspecialidadesService implements EspecialidadesServiceInterface
{

    public function store(array $data)
    {
        $nome=$data['nome'];

        Especialidade::create(['nome'=>$nome]);
    }

    public function getAll()
    {
        return Especialidade::all()->toArray();
    }

    public function getPaginado(): null | LengthAwarePaginator
    {
        $especialidades = Especialidade::all();
        if($especialidades->isEmpty()){
            return null;
        }
        return $especialidades->toQuery()->paginate(10);
    }
}
