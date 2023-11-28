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

                <div class="card-body" style="overflow-y: scroll; line-height: 1em; height:395px;">              
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/rutas') }}"  title="Editar"><i class="fa-solid fa-road-circle-exclamation"></i> Regresar</a>
                        @foreach($rutas_principales as $rp)
                            <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/ruta/'.$rp->id) }}"  title="Editar"><i class="fa-solid fa-road-circle-exclamation"></i> {{$rp->ubicacion->nomenclatura.'0'.$rp->correlativo}}</a>
                        @endforeach

                        
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-5">
            <div class="card ">

                <div class="card-header">                
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Desgloce de la Ruta: {{$ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo}}</strong></h2>

                </div>

                <div class="card-body " style="text-align:center; overflow-y: scroll; line-height: 1em; height:325px;">  
                    <ol class="list-group list-group-numbered">
                        @php($total_raciones = 0)
                        @if(count($detalles_ruta_escuelas) > 0)
                            @foreach($detalles_ruta_escuelas as $det)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"> 
                                            {{$det->escuela}} - Total Raciones: {{number_format($det->total_raciones)}} <a href="#" data-action="detalle" data-path="admin/escuela" data-object="{{ $idSolicitud}}" data-object1="{{ $det->escuela_id}}" class="btn-detalle" data-toogle="tooltrip" data-placement="top" title="Ver Detalle" ><i class="fa-solid fa-eye"></i> Detalle</a> 
                                            @php($total_raciones += $det->total_raciones)
                                        </div>                                                                                                          
                                    </div>
                                    
                                </li>
                            @endforeach
                        @else
                            <strong style="color: red;">Ruta sin datos, asigne las escuelas primero.</strong>
                        @endif
                    </ol>
                </div> 

                <div class="card-footer clearfix">
                    <strong>Raciones de la Ruta: {{number_format($total_raciones)}}</strong> 
                </div>

            </div>
        </div>

        <div class="col-md-5">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Detalle de la Escuela</strong>   </h2>
                    
                </div>

                <div class="card-body" style="text-align:center; overflow-y: scroll; line-height: 1em; height:370px; text-align:center;">  
                    <div id="msg-det-escuelas" >
                        <strong style="color: red;">Seleccione una escuela para ver su detalle.</strong>
                    </div>

                    <div id="det-escuelas" style="display: none;">
                        <div>
                            <strong>Solicitudes PrePrimaria a Tercero Primaria</strong>
                            <div class="col-md-3 mtop16">
                                <label for="name"> <strong>Total de Raciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div>
                            <strong>Solicitudes Cuarto a Sexto Primaria</strong>
                        </div>
                        <hr>
                        <div>
                            <strong>Solicitudes Voluntarios y Docentes</strong>
                        </div>
                        <hr>
                        <div>
                            <strong>Solicitudes Lideres</strong>
                        </div>

                        

                        
                    </div>
                    
                        
                </div> 

                <div class="card-footer clearfix">

                </div>

            </div>
        </div>

        

    </div>


    <div class="row mtop16">

        

        <div class="col-md-6">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Administración de la Ruta</strong>   </h2>
                    
                </div>

                <div class="card-body" style="text-align:center;">  
                    
                </div> 

                <div class="card-footer clearfix">

                </div>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Administración de la Ruta</strong>   </h2>
                    
                </div>

                <div class="card-body" style="text-align:center;">  
                    
                </div> 

                <div class="card-footer clearfix">

                </div>

            </div>
        </div>


        

    </div>
</div>

@endsection