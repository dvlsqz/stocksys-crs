@extends('admin.plantilla.master')
@section('title','Solicitudes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-file-invoice"></i> Listado de Solicitudes</strong></h2>
                    <ul>                       
                        <li>
                            <a href="{{ url('/admin/solicitud_despacho/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> ID </strong></td>
                                <td><strong> ENTREGA </strong></td>
                                <td><strong> USUARIO </strong></td>
                                <td><strong> ESTADO </strong></td>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $s)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            <a href="{{ url('/admin/escuela/'.$s->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            <a href="#" data-action="eliminar" data-path="admin/solicitud" data-object="{{ $s->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>{{ $s->id }}</td>
                                    <td>{{ obtenerMeses(null, $s->entrega->mes_inicial).' / '.obtenerMeses(null, $s->entrega->mes_final) }}</td>
                                    <td>{{ $s->usuario->nombres.' '.$s->usuario->apellidos}}</td>
                                    <td></td>
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