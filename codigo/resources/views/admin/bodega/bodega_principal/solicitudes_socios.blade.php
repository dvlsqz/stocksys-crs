@extends('admin.plantilla.master')
@section('title','Solicitudes de Socios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Bodega Principal</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Solicitudes de Socios</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card ">

                <div class="card-header">                
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Listado de Solicitudes de Socios</strong></h2>

                </div>

                <div class="card-body" >  
                    <table id="tabla" class="table table-striped table-hover mtop16" style="text-align:center;">
                        <thead>
                            <tr>
                                <td><strong> FECHA</strong></td>
                                <td><strong> SOCIO </strong></td>
                                <td><strong> ESTADO</strong></td>
                                <td><strong> VER</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $s)
                                <tr>
                                    <td>{{$s->fecha}}</td>
                                    <td>{{$s->id_socio_solicitante}} </td>
                                    <td>{{$s->estado}}</td>
                                    <td width="240px">
                                        <div class="opts">
                                            <a class="btn btn-outline-info" href="{{ url('/admin/bodega_principal/solicitudes_socios/'.$s->id.'/detalles') }}" ><i class="fa-solid fa-eye"></i> Ver Detalles</a>
                                            
                                        </div>
                                    </td>
                                                                       
                                    
                                    
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>

                </div> 

            </div>
        </div>

        <div class="col-md-6">  

            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Detalle de la Solicitud</strong></h2>
                </div>

                <div class="card-body" style="text-align:center;">
                    <b style="color: red;">Seleccione una solicitud, para visualizar su detalle o contenido.</b>
                </div>

            </div>                
        </div>
        

    </div>
</div>

@endsection