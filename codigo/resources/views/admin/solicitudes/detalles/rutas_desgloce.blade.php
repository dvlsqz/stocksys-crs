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
                    <ol class="list-group list-group-numbered">
                        @php($total_raciones = 0)
                        @php($peso_racion =0 )
                        @if(count($detalles_ruta_escuelas) > 0)
                            @foreach($detalles_ruta_escuelas as $det)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"> 
                                            {{$det->escuela}} - Total Raciones: {{number_format($det->total_raciones)}} 
                                            @php($total_raciones += $det->total_raciones)
                                            
                                            <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover mtop16">
                                                <thead style="background-color: #c3f3ea">
                                                    <tr>
                                                        <th>RACION</th>
                                                        <th>DIAS / MES</th>
                                                        <th>TOTAL DE PREPRIMARIA A TERCERO PRIMARIA</th>
                                                        <th>TOTAL DE CUARTO A SEXTO PRIMARIA</th>
                                                        <th>TOTAL DE VOLUNTARIOS Y DOCENTES / LIDERES</th>
                                                        <th>TOTAL DE RACIONES</th>
                                                        <th>PESO TOTAL LBS</th>
                                                        <th>UNIDAD DE MEDIDA (LIBRAS/CAJAS)</th>
                                                        <th>PESO TOTAL (LIBRAS)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($detalles_solicitudes_escuelas as $det_s)  
                                                        @if($det->escuela_id == $det_s->escuela_id)
                                                            <tr>
                                                                <td> {{$det_s->tipo_racion}} </td>
                                                                <td> {{$det_s->dias_de_solicitud.' / '.$det_s->mes_de_solicitud}} </td>
                                                                <td> {{$det_s->total_pre_primaria_a_tercero_primaria}} </td>
                                                                <td> {{$det_s->total_cuarto_a_sexto}} </td>
                                                                <td> {{$det_s->total_de_docentes_y_voluntarios}} </td>
                                                                <td> {{ $det_s->dias_de_solicitud * ( $det_s->total_pre_primaria_a_tercero_primaria + $det_s->total_cuarto_a_sexto + $det_s->total_de_docentes_y_voluntarios ) }} </td>
                                                                @foreach($racion as $r)
                                                                    @if($det_s->tipo_de_actividad_alimentos == $r->id)
                                                                        @for($i=0; $i < count($r->alimentos); $i++)
                                                                            @php($peso_racion = $r->alimentos[$i]->cantidad)
                                                                        @endfor
                                                                        
                                                                    @endif
                                                                @endforeach
                                                                <td> {{$peso_racion}} </td>

                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
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