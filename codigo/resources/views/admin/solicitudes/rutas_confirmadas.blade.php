@extends('admin.plantilla.master')
@section('title','Inicio de Solicitud')

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
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Listado de Rutas Confirmadas Para El Despacho De Solicitud #</strong></h2>

                </div>

                <div class="card-body " style="text-align:center;">  

                    @if(count($rutas) > 0)                                    
                        @foreach($rutas as $r)
                            <p class="mtop16"> <b>{{$loop->iteration}}. {{$r->ruta_base->ubicacion->nombre.' - '.$r->nombre}} </b> </p>
                            <div class="row mtop16">
                                    <b style="color:blue;">Detalle de Ruta</b><br>
                                    
                                    @foreach($r->detalles as $det)
                                            <p> 
                                                <b>Escuela: </b> {{$det->escuela->codigo.' / '.$det->escuela->nombre}}
                                                <b>Orden de Llegada:</b> {{$det->orden_llegada}}
                                            </p>  

                                    @endforeach
                            </div>
                            <hr>
                            
                        @endforeach
                        
                                            
                    @else
                        <b style="color: red;">Listado sin datos,confirme o cree sub rutas de despacho para esta solicitud primero.</b>
                    @endif

                </div> 

            </div>
        </div>
        

    </div>
</div>




@endsection