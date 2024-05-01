@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Pacientes</h1>
        @if(!$pacientes)
            <div class="d-flex align-items-center justify-content-center vh-100">
                <div class="alert alert-dark">
                    Ainda não existem pacientes cadastrados. Clique <a href="{{route('pacientes.create')}}" class="alert-link">aqui</a> para cadastrar...
                </div>
            </div>
        @else

            <div id="pacientes-container">
                <div class="mt-2 mb-3">
                    <a href="{{route('pacientes.create')}}">
                        <button class="btn btn-primary">
                            <i class="fa fa-plus-square"></i>
                        </button>
                    </a>
                </div>
                <div class="list-group" id="list-pacientes">
                    @foreach($pacientes as $paciente)
                        <a href="{{route('pacientes.show',['id'=>$paciente->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$paciente->nome}}</h5>
                            </div>
                            <p class="mb-1">CPF: {{$paciente->cpf}}, Nasc:{{$paciente->dataNascimento}}</p>

                        </a>
                    @endforeach
                </div>
                <div id="paginacao">
                    {!! $links !!}
                </div>

            </div>


        @endif
    </div>
@endsection
