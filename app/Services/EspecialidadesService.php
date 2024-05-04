<?php

namespace App\Services;

use App\Interfaces\EspecialidadesServiceInterface;
use App\Models\Especialidade;
use Illuminate\Pagination\LengthAwarePaginator;

class EspecialidadesService implements EspecialidadesServiceInterface
{
    /**
     * Grava a especialidade a partir de um array de dados.
     *
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $nome=$data['nome'];

        Especialidade::create(['nome'=>$nome]);
    }

    /**
     * Busca todas as especialidades na tabela 'especialidades'
     *
     * @return mixed[]
     */
    public function getAll()
    {
        return Especialidade::all()->toArray();
    }

    /**
     * Faz uma busca paginada de especialidades, trazendo 10 registros por página.
     *
     * @return LengthAwarePaginator|null
     */
    public function getPaginado(): null | LengthAwarePaginator
    {
        $especialidades = Especialidade::all();
        if($especialidades->isEmpty()){
            return null;
        }
        return $especialidades->toQuery()->paginate(10);
    }
}
