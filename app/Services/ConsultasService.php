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

    /**
     * Busca na tabela 'consultas' um registro baseado no seu id
     *
     * @param int $id
     * @return ConsultaViewModel|null
     * @throws \Exception
     */
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

    /**
     * Busca todas as consultas de um médico (tabela 'consultas') a partir do id do médito
     *
     * @param int $medico_id
     * @return array|null Retorna um array de ConsultaViewModel
     * @throws \Exception
     */
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

    /**
     * Busca todas as consultas de um paciente (tabela 'consultas') a partir do id do paciente.
     *
     * @param int $medico_id
     * @return array|null Retorna um array de ConsultaViewModel
     * @throws \Exception
     */

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

    /**
     * Grava um registro de consulta a partir do array recebido. A função também associa a consulta a um medico e um paciente.
     *
     * @param array $data
     * @return int Id da consulta
     * @throws \Exception
     */

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

    /**
     * Busca, a partir do id do médico, todos os horários em que já possui uma consulta agendada
     * @param int $medicoId
     * @return array|null Lista de datas e horários no formato Y-m-d h:i:s
     */
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
