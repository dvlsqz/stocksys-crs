<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">StockSys</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/admin')}}" class="nav-link"><i class="fa-solid fa-chart-line"></i> Panel Principal</a>
        </li>
        

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-gear"></i> Configuraciones
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/admin/ubicaciones')}}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
            <li><a class="dropdown-item" href="{{url('/admin/instituciones')}}"><i class="fa-solid fa-building"></i> Instituciones</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-people-carry-box"></i> Entregas</a></li>
          </ul>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/admin/usuarios')}}" class="nav-link"><i class="fa-solid fa-users"></i> Usuarios</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link"><i class="fa-solid fa-school"></i> Escuelas</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"><i class="fa-solid fa-route"></i> Rutas</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"><i class="fa-solid fa-bowl-rice"></i> Raciones</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"><i class="fa-solid fa-wheat-awn-circle-exclamation"></i> Alimentos</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-box-archive"></i> Reportería
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/admin/ubicaciones')}}">Ubicaciones</a></li>
            <li><a class="dropdown-item" href="#">Instituciones</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-clock"></i> Bitacoras del Sistema</a></li>
          </ul>
        </li>


      </ul> 

      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> {{ Auth::user()->usuario }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/admin/ubicaciones')}}"><i class="fa-solid fa-user-gear"></i> Cuenta</a></li>
            <div class="dropdown-divider"></div>
            <li><a href="{{url('/cerrar_sesion')}}" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
          </ul>
        </li>

      </ul>

    </div>

  </div>
</nav>