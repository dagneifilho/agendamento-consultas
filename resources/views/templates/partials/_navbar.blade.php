<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{url('img/hospital.png')}}" alt="" width="30" height="30"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('medicos.index')}}">Medicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('especialidades.index')}}">Especialidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("pacientes.index")}}">Pacientes</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
