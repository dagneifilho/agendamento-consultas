<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid d-flex">
        <a class="navbar-brand mb-3" href="{{route('welcome')}}"><img src="{{url('img/hospital.png')}}" alt="" width="30" height="30"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a>
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
        <div class="navbar-nav ms-auto d-flex"  >
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                </li>
                @else
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
