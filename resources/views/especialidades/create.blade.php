@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Especialidades</h1>
        <div id="especialidades-container" class="align-items-center justify-content-center vh-100">
            <form action="{{route('especialidades.store')}}" method="POST" >
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome da especialidade">

                </div>
                <div role="group">
                    <button type="submit" class="btn btn-primary mr-2">Criar</button>
                    <a href="{{route('especialidades.index')}}">
                        <div class="btn btn-danger">Cancelar</div>
                    </a>
                </div>


            </form>
        </div>
    </div>

@endsection
