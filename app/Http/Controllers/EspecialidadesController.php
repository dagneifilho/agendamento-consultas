<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEspecialidadeRequest;
use App\Services\EspecialidadesService;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    protected EspecialidadesService $especialidadesService;

    public function __construct(EspecialidadesService $especialidadesService) {
        $this->especialidadesService = $especialidadesService;
    }
    public function index() {
        $especialidades = $this->especialidadesService->getAll();
        return view('especialidades.index')->with('especialidades', $especialidades);
    }

    public function create() {
        return view('especialidades.create');
    }
    public function store(StoreEspecialidadeRequest $request) {
        $this->especialidadesService->store($request->all());
        flash('Especialidade cadastrada com sucesso!')->success();
        return redirect()->route('especialidades.index');
    }
}
