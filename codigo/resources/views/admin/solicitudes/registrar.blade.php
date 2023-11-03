@extends('admin.plantilla.master')
@section('title','Registar Escuela')

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
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Solicitud de Despacho</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/solicitud/importar', 'files' => true]) !!}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Seleccionar Entrega: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <select name="entrega" id="entrega" style="width: 95%" >
                                        @foreach($entregas as $e)
                                            <option value=""></option>
                                            <option value="{{ $e->id }}">{{ $e->correlativo.'-'.$e->year.' => '.obtenerMeses(null, $e->mes_inicial).' / '.obtenerMeses(null, $e->mes_final) }}</option>
                                        @endforeach
                                    </select>            
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cargar Archivo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::file('solicitudes') !!}
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Cargar Datos', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>



@endsection