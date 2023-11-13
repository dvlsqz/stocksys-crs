@extends('admin.plantilla.master')
@section('title','Inicio de Solicitud')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Solicitud de Despacho</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Registrar Solicitud de Despacho</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Carga De Datos Para Solicitud De Despacho</strong></h2>
                    
                </div>

                <div class="card-body">
                    

                        <div class="row">
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> ID Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('id_solicitud', $solicitud->id, ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Inicio de Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('fecha', $solicitud->created_at, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Entrega A Procesar: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('entrega', obtenerMeses(null, $solicitud->entrega->mes_inicial).' / '.obtenerMeses(null, $solicitud->entrega->mes_final), ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Días A Cubrir En Esta Entrega: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('entrega', $solicitud->entrega->dias_a_cubrir, ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Usuario Que Inicia La Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('usuario', $solicitud->usuario->nombres.' '.$solicitud->usuario->apellidos, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>    
                            
                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong> Observaciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('observaciones', $solicitud->observaciones, ['class'=>'form-control','rows'=>'2', 'readonly']) !!}
                                </div>
                            </div>
                        </div>


                        

                
                </div>

            </div>
            
        </div>

    </div>

    <div class="row mtop16">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-users"></i> Validación de Información Importada</strong></h2>
                </div>

                <div class="card-body">

                    <table id="tabla-carga-datos" class="table table-striped table-hover display nowrap mtop16" width="100%">
                        <thead style="font-size: 1em; " >
                            <tr>
                                <td ><strong> FECHA SOLICITUD</strong></td>
                                <td ><strong> MUNICIPIO ESCUELA </strong></td>
                                <td ><strong> JORNADA ESCUELA </strong></td>
                                <td ><strong> CODIGO ESCUELA </strong></td>
                                <td ><strong> NOMBRE ESCUELA </strong></td>
                                <td ><strong> DIRECCION ESCUELA</strong></td>
                                <td ><strong> MES SOLICITUD </strong></td>
                                <td ><strong> DIAS DE SOLICITUD </strong></td>
                                <td ><strong> RUTA </strong></td>
                                <td ><strong> NIÑAS PRE PRIMARIA A TERCERO PRIMARIA </strong></td>
                                <td ><strong> NIÑOS PRE PRIMARIA A TERCERO PRIMARIA </strong></td>
                                <td ><strong> TOTAL NIÑOS PRE PRIMARIA A TERCERO PRIMARIA </strong></td>
                                <td ><strong> NIÑAS CUARTO A SEXTO PRIMARIA </strong></td>
                                <td ><strong> NIÑOS CUARTO A SEXTO PRIMARIA </strong></td>
                                <td ><strong> TOTAL NIÑOS CUARTO A SEXTO PRIMARIA </strong></td>
                                <td ><strong> TOTAL DE ESTUDIANTES </strong></td>
                                <td ><strong> TOTAL DE RACIONES DE ESTUDIANTES </strong></td>
                                <td ><strong> TOTAL DOCENTES </strong></td>
                                <td ><strong> TOTAL VOLUNTARIOS </strong></td>
                                <td ><strong> TOTAL DE DOCENTES Y VOLUNTARIOS </strong></td>
                                <td ><strong> TOTAL DE RACIONES DE DOCENTES Y VOLUNTARIOS </strong></td>
                                <td ><strong> TOTAL PERSONAS </strong></td>
                                <td ><strong> TOTAL DE RACIONES </strong></td>
                                <td ><strong> TIPO DE ACTIVIDAD ALIMENTOS </strong></td>
                                <td ><strong> NUMERO DE ENTREGA </strong></td>
                                <td ><strong> TIPO </strong></td>


                        </thead>
                        <tbody>
                            
                            @foreach($solicitud->detalles as $sd)
                               <td>{{$sd->fecha}}</td>
                               <td>{{$sd->escuela->ubicacion->nombre}}</td>
                               <td>{{$sd->escuela->jornada}}</td>
                               <td>{{$sd->escuela->codigo}}</td>
                               <td>{{$sd->escuela->nombre}}</td>
                               <td>{{$sd->escuela->direccion}}</td>
                               <td>{{$sd->mes_de_solicitud}}</td>
                               <td>{{$sd->dias_de_solicitud}}</td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection