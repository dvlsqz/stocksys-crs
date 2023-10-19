@extends('admin.plantilla.master')
@section('title','Ubicaciones')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Ubicación</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ubicacion/registrar', 'files' => true]) !!}
                        @include('admin.ubicaciones.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-8"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-file-alt"></i> <strong> Listados de Ubicaciones</strong></h2>

                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> NIVEL </strong></td>
                        </thead>
                        <tbody>
                            @foreach($ubicaciones as $u)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="" title="Editar" id="formularioEditar" data-toggle="modal" data-target='#practice_modal' data-id="{{ $u->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ url('/admin/ubicacion/'.$u->id.'/listado/n1') }}"  title="Listado"><i class="fa-solid fa-list"></i></a>
                                            <a href="#" data-action="eliminar" data-path="admin/ubicacion" data-object="{{ $u->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>{{$u->nombre}}</td>
                                    <td>{{$u->nivel}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>                
        </div>

    </div>

    <div class="row mtop16">
        <div class="col-md-4">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Importar Ubicaciones</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ubicacion/importar', 'files' => true]) !!}
                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cargar Archivo: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::file('ubicaciones') !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>
    </div>
</div>
@include('admin.ubicaciones.modal')
@include('admin.ubicaciones.scripts')


@endsection