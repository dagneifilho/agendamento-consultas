<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteStoreRequest;
use App\Interfaces\PacientesServiceInterface;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    protected PacientesServiceInterface $pacientesService;

    public function __construct(PacientesServiceInterface $pacientesService) {
        $this->pacientesService = $pacientesService;
    }
    public function index() {
        $rtn = $this->pacientesService->getAll();
        $pacientes = $rtn['pacientes'];
        $links = $rtn['links'];
        return view('pacientes.index')->with('pacientes',$pacientes)->with('links',$links);
    }
    public function create() {
        return view('pacientes.create');
    }

    public function store(PacienteStoreRequest $request) {
        $id = $this->pacientesService->storePaciente($request->all());

        flash('Paciente cadastrado com sucesso!')->success();
        return redirect()->route('pacientes.show',['id'=>$id]);
    }
    public function show(int $id) {
        $paciente = $this->pacientesService->getById($id);

        abort_if(!$paciente, 404);

        return view('pacientes.show')->with('paciente',$paciente);
    }
}
