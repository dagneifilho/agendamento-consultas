@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Médicos</h1>
        <div id="medicos-form-container">
            <form action="{{route('medicos.store')}}" method="POST">
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite o nome do médico">
                    <label for="crm" class="form-label mt-3">CRM: </label>
                    <input type="text" name="crm" class="form-control" placeholder="Digite o CRM do médico">
                    <label for="especialidade_id" class="form-label mt-3">Especialidade: </label>
                    <select name="especialidade_id" id="select_especialidade" class="form-select form-select-lg mt-3 ">
                        <option value="">Selecionar</option>
                        @foreach($especialidades as $especialidade)
                            <option value="{{$especialidade['id']}}">{{$especialidade['nome']}}</option>
                        @endforeach
                    </select>
                    <div role="group" class="mt-3">
                        <button class="btn btn-success mr-3" type="submit">Cadastrar</button>
                        <a href="{{route('medicos.index')}}">
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


