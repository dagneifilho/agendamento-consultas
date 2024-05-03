<?php

namespace App\Services;

use App\Interfaces\ConsultasServiceInterface;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Paciente;
use App\ViewModels\ConsultaViewModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class ConsultasService implements ConsultasServiceInterface
{

    public function getConsultaById(int $id): ?ConsultaViewModel
    {
        $consulta = DB::table('consultas')
            ->leftJoin('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->leftJoin('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->where('consultas.id', '=', $id)
            ->select('consultas.*','medicos.id as medico_id', 'medicos.nome as medico', 'pacientes.nome as paciente', 'pacientes.id as paciente_id')
            ->first();
        if (!$consulta)
            return null;

        return ConsultaViewModel::fromData((array) $consulta);
    }

    public function getConsultasByMedicoId(int $medico_id): ?array
    {
        $consultas = DB::table('consultas')
            ->leftJoin('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->leftJoin('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->where('consultas.medico_id', '=', $medico_id)
            ->select('consultas.*','medicos.id as medico_id', 'medicos.nome as medico', 'pacientes.nome as paciente', 'pacientes.id as paciente_id')
            ->get();

        $consultasVm = [];
        foreach($consultas as $consulta) {
            $consultasVm[] = ConsultaViewModel::fromData((array) $consulta);
        }
        return $consultasVm;
    }

    public function getConsultasByPacienteId(int $pacienteId): ?array
    {
        $consultas = DB::table('consultas')
            ->leftJoin('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->leftJoin('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->where('consultas.paciente_id', '=', $pacienteId)
            ->select('consultas.*','medicos.id as medico_id', 'medicos.nome as medico', 'pacientes.nome as paciente', 'pacientes.id as paciente_id')
            ->get();

        $consultasVm = [];
        foreach($consultas as $consulta) {
            $consultasVm[] = ConsultaViewModel::fromData((array) $consulta);
        }
        return $consultasVm;
    }

    public function storeConsuta(array $data): int
    {
        $medico = Medico::find($data['medico_id']);
        $paciente = Paciente::find($data['paciente_id']);



        $consulta = Consulta::create([
            'data'=>new DateTime($data['horario'])
        ]);

        $consulta->paciente()->associate($paciente);
        $consulta->medico()->associate($medico);

        $consulta->save();

        return $consulta->id;
    }

    public function getHorariosIndisponiveisByMedicoId(int $medicoId): ?array
    {
        $now = Carbon::now();
        $consultas = DB::table('consultas')
            ->where('consultas.medico_id', '=', $medicoId)
            ->whereDate('consultas.data','>=',$now->toDateString())
            ->whereTime('consultas.data','>', $now->toTimeString())
            ->select('consultas.data')
            ->get();
        $horarios = [];
        foreach ($consultas as $consulta){
            $horarios[] = $consulta->data;
        }
        return $horarios;
    }
}
