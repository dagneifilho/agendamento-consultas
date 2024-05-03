<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultaRequest;
use App\Interfaces\ConsultasServiceInterface;
use App\Interfaces\MedicosServiceInterface;
use App\Interfaces\PacientesServiceInterface;

class ConsultasController extends Controller
{
    protected ConsultasServiceInterface $consultasService;
    protected MedicosServiceInterface $medicosService;
    protected PacientesServiceInterface $pacientesService;
    public function __construct(ConsultasServiceInterface $consultasService, MedicosServiceInterface $medicosService, PacientesServiceInterface $pacientesService){
        $this->consultasService = $consultasService;
        $this->medicosService = $medicosService;
        $this->pacientesService = $pacientesService;
    }
    public function create(int $medico_id) {
        $medico = $this->medicosService->getById($medico_id);
        $pacientes = $this->pacientesService->getAll();

        abort_if(!$medico, 404);

        $horariosIndisponiveis = $this->consultasService->getHorariosIndisponiveisByMedicoId($medico_id);
        return view('consultas.create')->with('horariosIndisponiveis', $horariosIndisponiveis)->with('medico', $medico)->with('pacientes', $pacientes);
    }
    public function store(StoreConsultaRequest $request) {
        $id = $this->consultasService->storeConsuta($request->all());

        flash('Consulta marcada com sucesso!')->success();

        return redirect()->route('consultas.show', ['id' => $id]);
    }
    public function show(int $id){
        $consulta = $this->consultasService->getConsultaById($id);
        abort_if(!$consulta,404);

        return view('consultas.show')->with('consulta', $consulta);
    }
    public function getByMedico(int $medico_id){
        $consultas = $this->consultasService->getConsultasByMedicoId($medico_id);
        return view('consultas.medicos')->with('consultas', $consultas);

    }
    public function getByPaciente(int $paciente_id){
        $consultas = $this->consultasService->getConsultasByPacienteId($paciente_id);
        return view('consultas.pacientes')->with('consultas', $consultas);
    }
}
