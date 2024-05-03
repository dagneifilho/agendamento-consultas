@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Consultas</h1>
        @if(!$consultas || count($consultas)==0)
            <div class="d-flex align-items-center justify-content-center vh-100">
                <div class="alert alert-dark">
                    Este médico ainda não possui consultas agendadas.
                </div>
            </div>
        @else
            <div id="consultas-container">
                <div class="list-group" id="list-pacientes">
                    @foreach($consultas as $consulta)
                        <a href="{{route('consultas.show',['id'=>$consulta->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$consulta->paciente}}</h5>
                            </div>
                            <p class="mb-1">Data / Horário: {{$consulta->horario}}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
