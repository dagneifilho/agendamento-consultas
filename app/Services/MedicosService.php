<?php

namespace App\Services;

use App\Interfaces\MedicosServiceInterface;
use App\Models\Especialidade;
use App\Models\Medico;
use App\ViewModels\MedicoViewModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class MedicosService implements MedicosServiceInterface
{

    public function getPaginado(?string $query = null): ?array
    {
        $medicos = $this->buscaMedicos($query);

        if(!$medicos)
            return null;

        $medicos = $medicos->paginate(10);
        $links = $medicos->links();

        $medicosVm=[];
        foreach ($medicos as $medico) {

            $medicoVm = MedicoViewModel::fromData((array)$medico);

            $medicosVm[] = $medicoVm;
        }

        return[
          'links'=>$links,
          'medicosVm'=>$medicosVm
        ];
    }

    public function getAll(?array $query = null): array
    {
        return Medico::all()->toArray();
    }

    public function getById(int $id): MedicoViewModel|null
    {
        $medico = DB::table("medicos")
            ->leftJoin('especialidades', 'medicos.especialidade_id','=','especialidades.id')
            ->where("medicos.id", $id)
            ->select('medicos.*','especialidades.nome as especialidade')
            ->first();
        if(!$medico)
            return null;
        $medicoVm = MedicoViewModel::fromData((array)$medico);

        return $medicoVm;
    }

    public function store(array $data): int
    {
        $especialidade = Especialidade::find($data['especialidade_id']);

        $medico = [
            'nome' => $data['nome'],
            'crm' => $data['crm']
        ];

        $medico = Medico::create($medico);
        $medico->especialidade()->associate($especialidade);
        $medico->save();

        return $medico->id;
    }

    private function buscaMedicos(?string $query){
        if($query)
            $medicos = DB::table("medicos")
                ->leftJoin('especialidades', 'medicos.especialidade_id','=','especialidades.id')
                ->where(DB::raw('UPPER(medicos.nome)'),'LIKE','%'.strtoupper($query).'%')
                ->orWhere(DB::raw('UPPER(medicos.crm)'),'=',strtoupper($query))
                ->orWhere(DB::raw('UPPER(especialidades.nome)'),'LIKE','%'.strtoupper($query).'%')
                ->select('medicos.*','especialidades.nome as especialidade');
        else
            $medicos = DB::table("medicos")
            ->leftJoin('especialidades', 'medicos.especialidade_id','=','especialidades.id')
            ->select('medicos.*','especialidades.nome as especialidade');
        return $medicos;
    }
}
