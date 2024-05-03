@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Médicos</h1>
        @if(!$medicos)
            <div class="d-flex align-items-center justify-content-center vh-100">
                <div class="alert alert-dark">
                    Ainda não existem médicos cadastrados ou você fez uma busca que não trouxe resultados. Clique <a href="{{route('medicos.create')}}" class="alert-link">aqui</a> para cadastrar...
                </div>
            </div>
        @else

            <div id="medicos-container">
                <div class="row" id="list-header">
                    <form action="{{route('medicos.index')}}" method="GET" class="d-flex col-sm-10">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="buscaMedico" name="search" placeholder="Digite nome, CRM ou especialidade">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="col-sm-2 ml-auto">
                        <a href="{{route('medicos.create')}}" class="ml-auto btn btn-primary btn-block">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    </div>
                </div>

                <div class="list-group" id="list-medicos">
                    @foreach($medicos as $medico)
                        <a href="{{route('medicos.show',['id'=>$medico->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$medico->nome}}</h5>
                            </div>
                            <p class="mb-1"><strong>Especialidade:</strong> {{$medico->especialidade}}</p>
                            <small class="mb-1"><strong>CRM:</strong> {{$medico->crm}}</small>

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
