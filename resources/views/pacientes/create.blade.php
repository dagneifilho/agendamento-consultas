@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Pacientes</h1>
        <div id="pacientes-form-container">
            <form action="{{route('pacientes.store')}}" method="POST">
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                    <label for="cpf" class="form-label">CPF: </label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" onblur="formataCpf('cpf')" placeholder="___.___.___-__">
                    <label for="dataNascimento" class="form-label">Data de Nascimento: </label>
                    <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" onblur="verificaIdade()" required>
                    <label for="telefones" class="form-label">Telefones: </label>
                    <div id="telefones-container">
                        <div>
                            <label class="form-label" for="telefones['numero'][]">Telefone:</label>
                            <input type="text" class="form-control" name="telefones[numero][]" placeholder="(##) #####-####" required>
                            <label class="form-label" for="telefones[descricao][]">Descrição: </label>
                            <input type="text" class="form-control mb-3" name="telefones[descricao][]" placeholder="Descrição">
                        </div>
                       </div>
                    <div role="group" class="mb-3">
                        <button class="btn btn-primary mr-2" type="button" onclick="addInputTelefone()">
                            <i class="fa fa-plus-square"></i>
                        </button>
                        <button class="btn btn-danger ml-2" type="button" onclick="removeInputTelefone()">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" class="form-control" name="email" placeholder="example@example.com" required>
                    <label for="cep" class="form-label">CEP: </label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="#####-###" onblur="getEndereco()" required>
                    <label for="endereco" class="form-label">Endereço: </label>
                    <input type="text" disabled class="form-control" id="endereco">
                    <input type="hidden" class="form-control" id="endereco-hdn" name="endereco">
                    <label for="numero" class="form-label"> Número: </label>
                    <input type="number" class="form-control" name="numero" required>
                    <div id="container-responsavel">

                    </div>
                    <div role="group" class="mt-3">
                        <button class="btn btn-success mr-3" type="submit">Cadastrar</button>
                        <a href="{{route('pacientes.index')}}">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>

</script>


