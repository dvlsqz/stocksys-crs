@extends('admin.plantilla.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/reportes') }}"><i class="fa-solid fa-file-lines"></i> Reportes</a></li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Generar Reporte</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/reporte/panel/generar', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-6">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Socio: </strong></label>
                            <div class="input-group">           
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="id_socio" id="id_socio" style="width: 90%" >
                                    @foreach($socio as $s)
                                        <option value=""></option>
                                        <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                                    @endforeach
                                </select>       
                                <a href="#" class="btn btn-sm btn-info " id="btn_buscar_socio_solicitudes_despacho" data-toogle="tooltrip" data-placement="top" title="Buscar" ><i class="fas fa-search"></i> </a>      
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Solicitudes de Despacho: </strong></label>
                            <div class="input-group">           
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="id_solicitud" id="id_solicitud" style="width: 90%" >
                                    <option value=""></option>
                                    
                                </select>             
                            </div>
                        </div>
                    </div>

                    {!! Form::submit('Generar', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>


    </div>
</div>
@endsection