@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Consultas</h1>

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Detalhes da Consulta</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Médico: </strong><a href="{{route('medicos.show',['id'=>$consulta->medico_id])}}">{{$consulta->medico}}</a></li>
                        <li class="list-group-item"><strong>Paciente: </strong> <a href="{{route('pacientes.show',['id'=>$consulta->paciente_id])}}">{{$consulta->paciente}}</a></li>
                        <li class="list-group-item"><strong>Data / Horário:</strong> {{$consulta->horario}}</li>
                        <li class="list-group-item"><strong>Agendado Em:</strong> {{$consulta->agendamento}}</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
