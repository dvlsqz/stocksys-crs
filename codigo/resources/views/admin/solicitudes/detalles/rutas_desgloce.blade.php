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

        <div class="col-md-10">
            <div class="card ">

                <div class="card-header">                
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Desgloce de la Ruta: {{$ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo}}</strong></h2>

                </div>

                <div class="card-body " style="text-align:center; overflow-y: scroll; line-height: 1em; height:325px;">  
                    @if(count($detalles_ruta_escuelas) > 0)                                    
                        @foreach($detalles_ruta_escuelas as $det)
                            <p class="mtop16"><i class="fa-solid fa-circle-right"></i> <b> {{$det->escuela}} - Total Raciones: {{number_format($det->total_raciones)}}</b> </p>
                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <b style="color:blue;">Niños Pre Primaria a Tercero Primaria</b><br>
                                    @foreach($det_escuelas_preprimaria as $det1)
                                        @if($det1->escuela_id == $det->escuela_id)
                                            <p> 
                                                <b>Dias/Mes:</b> {{ $det1->dias }} <b>No. Beneficiarios:</b> {{ $det1->total_ninos }} <br>
                                                <b>Raciones:</b> {{ number_format($det1->dias * $det1->total_ninos)}}
                                            </p>  
                                        @endif

                                            {{ $peso_raciones_estudiantes}}
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <b style="color:blue;">Niños Cuarto Primaria a Sexto Primaria</b><br>
                                    @foreach($det_escuelas_primaria as $det2)
                                        @if($det2->escuela_id == $det->escuela_id)
                                            <p> 
                                                <b>Dias/Mes:</b> {{ $det2->dias }} <b>No. Beneficiarios:</b> {{ $det2->total_ninos }} <br>
                                                <b>Raciones:</b> {{ number_format($det2->dias * $det2->total_ninos)}}
                                            </p>

                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <b style="color:blue;">Lideres</b><br>
                                    @foreach($det_escuelas_l as $det3)
                                        @if($det3->escuela_id == $det->escuela_id)
                                            <p> 
                                                <b>Dias/Mes:</b> {{ $det3->dias }} <b>No. Beneficiarios:</b> {{ $det3->total_personas }} <br>
                                                <b>Raciones:</b> {{ number_format($det3->dias * $det3->total_personas)}}
                                            </p> 
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-3">                                    
                                    <b style="color:blue;">Voluntarios y Docentes</b><br>
                                    @foreach($det_escuelas_v_d as $det4)
                                        @if($det4->escuela_id == $det->escuela_id)
                                            <p> 
                                                <b>Dias/Mes:</b> {{ $det4->dias }} <b>No. Beneficiarios:</b> {{ $det4->total_personas }} <br>
                                                <b>Raciones:</b> {{ number_format($det4->dias * $det4->total_personas)}}
                                            </p> 
                                        @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                            <hr>
                        @endforeach
                                          
                    @else
                        <strong style="color: red;">Ruta sin datos, asigne las escuelas primero.</strong>
                    @endif

                </div> 

                <div class="card-footer clearfix">
                    <strong>Raciones de la Ruta: {{number_format($total_raciones)}}</strong> 
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