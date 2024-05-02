<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicosRequest;
use App\Interfaces\EspecialidadesServiceInterface;
use App\Interfaces\MedicosServiceInterface;
use App\Services\EspecialidadesService;
use Illuminate\Http\Request;

class MedicosController extends Controller
{
    protected EspecialidadesServiceInterface $especialidadesService;
    protected MedicosServiceInterface $medicosService;

    public function __construct(EspecialidadesServiceInterface $especialidadesService, MedicosServiceInterface $medicosService)
    {
        $this->especialidadesService = $especialidadesService;
        $this->medicosService = $medicosService;
    }

    public function index(Request $request) {
        $query = $request->input('search');

        $rtn = $this->medicosService->getPaginado($query);
        $medicos = isset($rtn['medicosVm']) ? $rtn['medicosVm'] : null;
        $links = isset($rtn['links'])?$rtn['links']:null;
        return view('medicos.index')->with('medicos',$medicos)->with('links',$links);
    }

    public function create(){
        $especialidades = $this->especialidadesService->getAll();
        return view('medicos.create')->with('especialidades', $especialidades);
    }

    public function store(StoreMedicosRequest $request){
        $id = $this->medicosService->store($request->all());

        flash('Médico cadastrado com sucesso!')->success();
        return redirect()->route('medicos.show',['id'=>$id]);

    }
    public function show(int $id){
        $medico = $this->medicosService->getById($id);

        abort_if(!$medico, 404);

        return view('medicos.show')->with('medico',$medico);
    }
}
