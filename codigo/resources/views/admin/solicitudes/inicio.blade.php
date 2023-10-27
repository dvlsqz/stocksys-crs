@extends('admin.plantilla.master')
@section('title','Solicitudes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Importar Solicitudes</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/solicitud/importar', 'files' => true]) !!}
                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cargar Archivo: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::file('solicitudes') !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-file-invoice"></i> Listado de Solicitudes</strong></h2>
                    <ul>                       
                        <li>
                            <a href="{{ url('/admin/escuela/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> UBICACIÓN </strong></td>
                                <td><strong> ESTADO </strong></td>
                        </thead>
                        <tbody>
                            
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