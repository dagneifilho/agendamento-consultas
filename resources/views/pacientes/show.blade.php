@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Pacientes</h1>

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Detalhes do Paciente</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nome:</strong> {{$paciente->nome}}</li>
                        <li class="list-group-item"><strong>CPF:</strong> {{$paciente->cpf}}</li>
                        <li class="list-group-item"><strong>Data de Nascimento:</strong> {{$paciente->dataNascimento}}</li>
                        <li class="list-group-item"><strong>Data de Cadastro:</strong> {{$paciente->dataCadastro}}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{$paciente->email}}</li>
                        <li class="list-group-item"><strong>CEP:</strong> {{$paciente->cep}}</li>
                        <li class="list-group-item"><strong>Endereço:</strong> {{$paciente->endereco}}</li>
                        <li class="list-group-item"><strong>Número:</strong> {{$paciente->numero}}</li>
                        @if($paciente->cpfResponsavel)
                            <li class="list-group-item"><strong>Nome do Responsável:</strong> {{$paciente->nomeResponsavel}}</li>
                            <li class="list-group-item"><strong>CPF do Responsável:</strong> {{$paciente->cpfResponsavel}}</li>
                        @endif

                    </ul>
                </div>
                <div class="card-footer">
                    <h5>Telefones:</h5>
                    <ul class="list-group">
                        @foreach($paciente->telefones as $telefone)
                            <li class="list-group-item"><strong>Número: </strong> {{$telefone['numero']}} | {{$telefone['descricao']}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="group" class="mt-3">
                <a href="#">
                    <button type="button" class="btn btn-primary">Agendar Consulta</button>
                </a>
                <a href="{{route('pacientes.index')}}">
                    <button type="button" class="btn btn-secondary">Voltar</button>
                </a>
            </div>
        </div>
    </div>
@endsection
