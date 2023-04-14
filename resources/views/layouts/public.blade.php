<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Bootstrap demo</title>
  </head>
  <body>
    {{--sidebar--}}
    <div class="main-container d-flex">
      <div class="sidebar" id="side_nav">
        <div class="header-box px-2 pt-3 pb-4">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/olho-logo.png') }}" alt="Logo" width="45" height="30" class="d-inline-block align-text-top"><span class="logo-texto"> Ophtamuls</span>
          </a>
        </div>
        <ul class="list-unstyled px-3">
          <li><a href="#" class="text-decoration-none d-block"><span class="material-symbols-outlined icon">
            patient_list
            </span> Paciente</a></li>
          <li><a href="#" class="text-decoration-none d-block"><span class="material-symbols-outlined icon">
            account_circle</span> Usuário</a></li>
          <li><a href="#" class="text-decoration-none d-block"> Consultas</a></li>
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
              <form class="d-flex" role="search">
                <input class="form-control me-2 " type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>
              </form>
            </div>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Nome do Usuário
                  </a>
                  <ul class="dropdown-menu">
                      @if (Route::has('login'))
                          @auth
                            <li><a href="{{ url('/dashboard') }}" class="dropdown-item">Dashboard</a></li>
                            @else
                            <li><a href="{{ route('login') }}" class="dropdown-item">Log in</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="dropdown-item">Register</a></li>
                            @endif
                          @endauth
                      @endif
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Log Out</a></li>
                  </ul>
                  </li>
              </ul>
          </div>
      </nav>
      </div>
    </div>

    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script>
      $('.sidebar ul li').on('click' , function(){
        $('.sidebar ul li.active').removeClass('active');
        $(this).addClass('active');
      })
    </script>
  </body>
</html>