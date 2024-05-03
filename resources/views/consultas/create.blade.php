@extends('templates.app')

@section('content')
    <div id="main-container">
        <h1>Consultas</h1>
        <div id="consultas-container" class="align-items-center justify-content-center vh-100">
            <form action="{{route('consultas.store')}}" method="POST" >
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="medico_id" class="form-label">Médico: </label>
                    <input type="text" disabled class="form-control" name="medico_id" id="nome" value="{{$medico->nome}} - {{$medico->especialidade}}">
                    <input type="hidden" class="form-control" name="medico_id" value="{{$medico->id}}">
                    <label for="paciente_id" class="form-label">Paciente: </label>
                    <select name="paciente_id" class="form-select form-select-lg">
                        <option value="">Selecionar</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{$paciente->id}}">{{$paciente->nome}}</option>
                        @endforeach
                    </select>
                    <div>
                        <label class="form-label" for="data">Escolha uma data:</label>
                        <input class="form-control" type="date" id="data" onblur="setHorario()">
                    </div>
                    <div>
                        <label class="form-label" for="horario">Escolha um horário:</label>
                        <select class="form-select form-select-lg" id="hora" onblur="setHorario()">
                            <option value="">Selecione uma data primeiro</option>
                        </select>
                    </div>
                    <input type="hidden" id="agendamento" name="horario" >

                </div>
                <div role="group">
                    <button type="submit" class="btn btn-primary mr-2">Agendar</button>
                    <a href="{{route('medicos.index')}}">
                        <div class="btn btn-danger">Cancelar</div>
                    </a>
                </div>


            </form>
        </div>
    </div>

    <script>
        document.getElementById('data').addEventListener('change', function() {
            var selectedDate = this.value;
            var horariosIndisponiveis = {!! json_encode($horariosIndisponiveis) !!};
            console.log(horariosIndisponiveis)
            var selectHorario = document.getElementById('hora');
            selectHorario.innerHTML = '';
            var startTime = new Date(selectedDate + 'T08:00:00');
            var endTime = new Date(selectedDate + 'T18:00:00');
            var currentTime = new Date(startTime);
            while (currentTime <= endTime) {
                var horaFormatada = currentTime.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit', second:'2-digit'});
                dataHora = selectedDate + ' ' + horaFormatada
                if (!horariosIndisponiveis.includes(dataHora)) {
                    var option = document.createElement('option');
                    option.text = horaFormatada;
                    option.value = horaFormatada;
                    selectHorario.appendChild(option);
                }
                currentTime.setHours(currentTime.getHours() + 1);
            }
        });

        function setHorario(){
            let horarioInput = document.getElementById('agendamento')
            let data = document.getElementById('data').value
            let hora = document.getElementById('hora').value

            let horarioFormatado = data + ' ' + hora

            horarioInput.value = horarioFormatado
        }
    </script>

@endsection
