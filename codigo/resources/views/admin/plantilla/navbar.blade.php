<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">    
    <a class="navbar-brand" href="{{url('/admin')}}"><img src="{{url('/static/imagenes/crs_1.png')}}" alt="" width="24px" height="24px" style="margin-top: -4px;">  StockSys</a>
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
            <li><a class="dropdown-item" href="{{url('/admin/entregas')}}"><i class="fa-solid fa-people-carry-box"></i> Entregas</a></li>
          </ul>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/admin/usuarios')}}" class="nav-link"><i class="fa-solid fa-users"></i> Usuarios</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/admin/escuelas')}}" class="nav-link"><i class="fa-solid fa-school"></i> Escuelas</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/admin/rutas')}}" class="nav-link"><i class="fa-solid fa-route"></i> Rutas</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa-solid fa-boxes-packing"></i>  Almacen </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{url('/admin/insumos')}}" class="nav-link"><i class="fa-solid fa-boxes-stacked"></i> Insumos</a>
            </li>

            <li >
              <a href="{{url('/admin/raciones')}}" class="nav-link"><i class="fa-solid fa-bowl-rice"></i> Raciones</a>
            </li>  
            

            <li ><a class="dropdown-item" href="#"><i class="fa-solid fa-warehouse"></i> Bodega Principal <i class="fa-solid fa-caret-right"></i></a>
              <ul class="submenu dropdown-menu">
                <li><a class="dropdown-item" href=""><i class="fa-solid fa-calculator"></i> Inventario</a></li>
                <li><a class="dropdown-item" href=""><i class="fa-solid fa-right-to-bracket"></i> Registrar Ingresos</a></li>
                <li><a class="dropdown-item" href=""><i class="fa-solid fa-right-from-bracket"></i> Registrar Egresos </a>
              </ul>
            </li>

            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-warehouse"></i> Bodega Socio <i class="fa-solid fa-caret-right"></i></a>
              <ul class="submenu dropdown-menu">
                <li><a class="dropdown-item" href=""><i class="fa-solid fa-calculator"></i> Inventario</a></li>
                <li><a class="dropdown-item" href=""><i class="fa-solid fa-right-to-bracket"></i> Registrar Ingresos</a></li>
                <li><a class="dropdown-item" href=""><i class="fa-solid fa-right-from-bracket"></i> Registrar Egresos </a>
              </ul>
            </li>

          </ul>
        </li>              

        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('/admin/solicitudes_despachos')}}" class="nav-link"><i class="fa-solid fa-file-invoice"></i> Solicitudes de Despacho</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-box-archive"></i> Reportería
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/admin/ubicaciones')}}">Ubicaciones</a></li>
            <li><a class="dropdown-item" href="#">Instituciones</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="{{url('/admin/bitacoras')}}"><i class="fa-solid fa-user-clock"></i> Bitacoras del Sistema</a></li>
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