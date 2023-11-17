@extends('admin.plantilla.master')
@section('title','Editar Escuela')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')
@php($total_raciones = 0)
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-road-circle-exclamation"></i><strong> Listado de Rutas</strong></h2>
                    
                </div>

                <div class="card-body">              
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/rutas') }}"  title="Editar"><i class="fa-solid fa-road-circle-exclamation"></i> Regresar</a>
                        @foreach($rutas_principales as $rp)
                            <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/ruta/'.$rp->id) }}"  title="Editar"><i class="fa-solid fa-road-circle-exclamation"></i> {{$rp->ubicacion->nomenclatura.'0'.$rp->correlativo}}</a>
                        @endforeach

                        
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-10">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-road-circle-exclamation"></i><strong> Desgloce de la Ruta: {{$ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo}}</strong>   </h2>
                    
                </div>

                <div class="card-body">  
                    <ol class="list-group list-group-numbered">
                        @php($total_raciones = 0)
                        @foreach($detalles_ruta_escuelas as $det)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                <div class="fw-bold"> {{$det->escuela}} </div>
                                    <ol class="list-group list-group-numbered">
                                        @foreach($detalles_solicitud_escuelas as $det_solicitud)
                                            @if($det_solicitud->escuela_id == $det->escuela_id )
                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto">
                                                    <div class="">{{ $det_solicitud->tipo.': '.number_format($det_solicitud->total_raciones).' (mes: '.$det_solicitud->mes.')'}}</div>
                                                    
                                                </li>
                                            @endif
                                        @endforeach
                                    </o>                                                                         
                                </div>
                                <span class="badge bg-dark rounded-pill"><strong>Total Raciones: {{number_format($det->total_raciones)}}</strong></span>
                                @php($total_raciones += $det->total_raciones)
                            </li>
                        @endforeach
                    </ol>
                </div> 

                <div class="card-footer clearfix">
                    <strong>Raciones de la Ruta: {{number_format($total_raciones)}}</strong> 
                </div>

            </div>
        </div>

        

    </div>
</div>

@endsection