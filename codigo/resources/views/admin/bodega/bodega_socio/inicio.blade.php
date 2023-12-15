@extends('admin.plantilla.master')
@section('title','Bodega Socio')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Socio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/inventario') }}"><i class="fa-solid fa-calculator"></i> Inventario</a></li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">  
        <div class="col-md-3 d-flex">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Insumo</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socio/insumo/registrar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

        <div class="col-md-9">  

            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Listado de Insumos</strong></h2>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> OPCIONES </strong></td>
                                <td><strong> INSUMO</strong></td>
                                <td><strong> SALDO EN BODEGA </strong></td>
                                <td><strong> CATEGORIA/TIPO</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insumos as $i)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if($i->categoria == 0)
                                                <a href="{{ url('/admin/bodega_socio/insumo/'.$i->id.'/pesos') }}"  title="Pesos"><i class="fa-solid fa-scale-unbalanced-flip"></i></a>
                                            @endif
                                            <a href="#" data-action="eliminar" data-path="admin/bodega_socio/insumo" data-object="{{ $i->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                        </div>
                                    </td>
                                    <td>{{$i->nombre}}</td>
                                    <td>
                                        {{$i->saldo}} <br>
                                        <small><strong>Unidad: </strong> {{ obtenerUnidadesMedidaInsumos(null, $i->id_unidad_medida) }}</small>
                                    </td>
                                    <td>{{obtenerCategoriaInsumos(null, $i->categoria)}}</td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>

            </div>                
        </div>
        

        
    </div>

    <div class="row">  

        <div class="col-md-3 mtop16">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Controles de Solicitud</strong></h2>
                    
                </div>

                <div class="card-body">              
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/insumo/ingresos') }}" title="Ingresos"><i class="fas fa-plus-circle"></i> Ingresos</a>
                        <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/insumo/egresos') }}" title="Egresos"><i class="fas fa-minus-circle"></i> Egresos</a>
                        <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/raciones/1') }}" title="raciones"><i class="fa-solid fa-bowl-rice"></i> Raciones</a>
                        <a class="btn btn-outline-primary" href="{{ url('/admin/bodega_socio/kits/1') }}" title="lits"><i class="fa-solid fa-boxes-stacked"></i> Kits</a>
                    </div>
                </div>

            </div>
        </div>
    
       

        

    </div>

</div>

@endsection