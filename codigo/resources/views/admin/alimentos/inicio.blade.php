@extends('admin.plantilla.master')
@section('title','Alimentos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/alimentos') }}"><i class="fa-solid fa-wheat-awn"></i> Alimentos</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Alimento</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/alimento/registrar', 'files' => true]) !!}
                        @include('admin.alimentos.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-wheat-awn"></i> Listado de Alimentos</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> SALDO BODEGA </strong></td>
                        </thead>
                        <tbody>
                            @foreach($alimentos as $a)
                                <tr>
                                    <td width="280px">
                                        <div class="opts">
                                            <a href="{{ url('/admin/alimento/'.$a->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            <a href="{{ url('/admin/alimento/'.$a->id.'/pesos') }}"  title="Pesos"><i class="fa-solid fa-scale-unbalanced-flip"></i></a>
                                            <a href="{{ url('/admin/alimento/'.$a->id.'/ingresos') }}"  title="Ingresos"><i class="fa-solid fa-file-circle-plus"></i></a>
                                            <a href="{{ url('/admin/alimento/'.$a->id.'/egresos') }}"  title="Egresos"><i class="fa-solid fa-file-circle-minus"></i></a>
                                            <a href="#" data-action="eliminar" data-path="admin/alimento" data-object="{{ $a->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>
                                        {{$a->nombre}} <br>
                                        <small><strong>Unidad Medida: </strong>{{ obtenerUnidadesMedidaAlimentos(null, $a->id_unidad_medida) }}</small> 
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>                
        </div>

    </div>

</div>

@endsection