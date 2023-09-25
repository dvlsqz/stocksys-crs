@extends('admin.plantilla.master')
@section('title','Rutas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/rutas') }}"><i class="fa-solid fa-route"></i> Rutas</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-route"></i> Listado de Rutas</strong></h2>
                    <ul>                       
                        <li>
                            <a href="{{ url('/admin/ruta/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar</a>
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
                            @foreach($rutas as $r)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="{{ url('/admin/ruta/'.$r->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            <a href="#" data-action="eliminar" data-path="admin/ruta" data-object="{{ $r->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>{{$r->nombre}}</td>
                                    <td>{{$r->id_ubicacion}}</td>
                                    <td>{{$r->estado}}</td>
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