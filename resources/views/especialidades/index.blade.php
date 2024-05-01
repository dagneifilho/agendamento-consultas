@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1 class="mb-5">Especialidades</h1>
        @if(!$especialidades)
            <div class="d-flex align-items-center justify-content-center vh-100">
                <div class="alert alert-dark">
                    Ainda não existem especialidades cadastradas. Clique <a href="{{route('especialidades.create')}}" class="alert-link">aqui</a> para cadastrar...
                </div>
            </div>
        @else

            <div id="especialidades-container">
                <div class="mt-2 mb-3">
                    <a href="{{route('especialidades.create')}}">
                        <button class="btn btn-primary">
                            <i class="fa fa-plus-square"></i>
                        </button>
                    </a>
                </div>
                <ul class="list-group" id="list-especialidades">
                    @foreach($especialidades as $especialidade)
                        <li class="list-group-item">{{$especialidade->nome}}</li>
                    @endforeach
                </ul>
                {{$especialidades->links()}}

            </div>

        @endif
    </div>

@endsection
