@extends('admin.plantilla.master')
@section('title','Registar Institución')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/instituciones') }}"><i class="fas fa-user-lock"></i> Instituciones</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/institucion/registrar') }}"><i class="fas fa-user-lock"></i> Editar Institucion</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Institución</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/institucion/'.$institucion->id.'/editar', 'files' => true]) !!}

                        @include('admin.instituciones.formulario')

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/instituciones') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection