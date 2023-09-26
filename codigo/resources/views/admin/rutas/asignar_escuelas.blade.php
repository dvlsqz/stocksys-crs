@extends('admin.plantilla.master')
@section('title','Asingar Escuelas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/rutas') }}"><i class="fa-solid fa-route"></i> Rutas</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/ruta'.$ruta->id.'/asignar_escuelas') }}"><i class="fa-solid fa-school"></i> Asginar Escuealas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Asignar Escuela</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ruta/registrar', 'files' => true]) !!}
                        

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-route"></i> Listado de Escuelas Asignadas A: Ruta {{$ruta->correlativo}}. - {{$ruta->ubicacion->nombre}}</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> RUTA </strong></td>
                                <td><strong> ESTADO </strong></td>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection