<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>@yield('title', 'Ophtamuls - Home')</title>
</head>

<body>
    {{-- sidebar --}}
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header px-2 pt-3 pb-4">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/olho-logo.png') }}" alt="Logo" width="45" height="30"
                        class="d-inline-block align-text-top"><span class="logo-texto"> Ophtamuls</span>
                </a>
            </div>
            <ul class="list-unstyled px-3">
                <li class="p-1 mb-2 @if (Route::is('pacientes.list')) active @endif"><a href="{{ route('pacientes.list') }}"
                        class="text-decoration-none d-block"><span class="material-symbols-outlined icon">
                            patient_list
                        </span> Pacientes</a></li>
                <li class="p-1 mb-2 @if (Route::is('consultas.list')) active @endif"><a href="{{ route('consultas.list') }}" class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            medical_services
                        </span> Consultas</a></li>
                <li class="p-1 mb-2 @if (Route::is('medicos.list')) active @endif"><a href="{{ route('medicos.list') }}"class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            stethoscope
                        </span> Médicos</a></li>
                <li class="p-1 mb-2 @if (Route::is('prontuarios.list')) active @endif"><a href="{{ route('prontuarios.list') }}" class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            assignment
                        </span> Prontuários</a></li>
                <li class="p-1 mb-2"><a href="#" class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            pill
                        </span> Medicamentos</a></li>
                <li class="p-1 mb-2 @if (Route::is('usuarios.list')) active @endif"><a href="{{ route('usuarios.list') }}" class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            account_circle</span> Usuários</a></li>
                <li class="p-1 mb-2"><a href="#" class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            login
                        </span> Acessos</a></li>
                <li class="p-1"><a href="#" class="text-decoration-none d-block"><span
                            class="material-symbols-outlined icon">
                            lab_profile
                        </span> Relatórios</a></li>
            </ul>

            <ul class="list-unstyled px-3" style="position: absolute; bottom: 0; left: 0;">
                <hr class="h-color mx-2">
                <li><a href="#" class="text-decoration-none d-block"><span class="material-symbols-outlined icon">
                            settings
                        </span> Configurações</a></li>
            </ul>
        </div>
        <div class="navbar-cima">


            <nav class="navbar navbar-expand-lg" style="background-color:#20B2AA">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse nav-fill justify-content-center" id="navbarSupportedContent">
                    </div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Nome do Usuário
                            </a>
                            <ul class="dropdown-menu">
                                @if (Route::has('login'))
                                    @auth
                                        <li><a href="{{ url('/dashboard') }}" class="dropdown-item">Dashboard</a></li>
                                    @else
                                        <li><a href="{{ route('login') }}" class="dropdown-item">Log in</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}" class="dropdown-item">Register</a></li>
                                        @endif
                                    @endauth
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('.sidebar ul li').on('click', function() {
            $('.sidebar ul li.active').removeClass('active');
            $(this).addClass('active');
        })
    </script>
</body>

</html>
