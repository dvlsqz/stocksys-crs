@extends('admin.plantilla.master')
@section('title','Editar Ración')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/raciones') }}"><i class="fa-solid fa-people-carry-box"></i> Raciones</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/racion/'.$racion->id.'/editar') }}"><i class="fa-solid fa-people-carry-box"></i> Editar Ración</a></li>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Ración</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/racion/'.$racion->id.'/editar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio..formulario')                        

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/raciones') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection