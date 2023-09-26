@extends('admin.plantilla.master')
@section('title','Escuelas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-school"></i> Escuelas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-school"></i> Listado de Escuelas</strong></h2>
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
                            @foreach($escuelas as $e)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="{{ url('/admin/escuela/'.$e->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            <a href="#" data-action="eliminar" data-path="admin/escuela" data-object="{{ $e->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>{{$e->nombre}}</td>
                                    <td>
                                        {{$e->direccion}}<br>
                                        {{$e->ubicacion->nombre.' / '.$e->ubicacion->ubicacion_superior->nombre.' / '.$e->ubicacion->ubicacion_superior->ubicacion_superior->nombre}}
                                    </td>
                                    <td>{{$e->estado}}</td>
                                </tr>
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