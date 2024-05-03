@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Médicos</h1>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes do Médico</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nome:</strong> {{$medico->nome}}</li>
                            <li class="list-group-item"><strong>CRM:</strong> {{$medico->crm}}</li>
                            <li class="list-group-item"><strong>Especialidade:</strong> {{$medico->especialidade}}</li>

                        </ul>
                    </div>
                </div>
                <div role="group" class="mt-3">
                    <a href="{{route('consultas.create', ['id'=>$medico->id])}}">
                        <button type="button" class="btn btn-success">Agendar Consulta</button>
                    </a>
                    <a href="{{route('consultas.medicos', ['id'=>$medico->id])}}">
                        <button type="button" class="btn btn-primary">Visualizar agendamentos</button>
                    </a>
                    <a href="{{route('medicos.index')}}">
                        <button type="button" class="btn btn-secondary">Voltar</button>
                    </a>
                </div>
            </div>
    </div>
@endsection
