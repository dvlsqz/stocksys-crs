<div class="col-md-3">
    <div class="card ">

        <div class="card-header">
            <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Administración de la Ruta</strong>   </h2>
            
        </div>

        <div class="card-body" >  
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><strong><i class="fa-solid fa-folder"></i> Confirmar Ruta Sin Dividir</strong>   </h2>
                    
                </div>

                <div class="card-body" >  
                {!! Form::open(['url' => '/admin/solicitud_despacho/confirmar_ruta/sin_division', 'files' => true]) !!}
                    {!! Form::hidden('id_solicitud', $idSolicitud, ['class'=>'form-control']) !!}
                    {!! Form::hidden('ruta_base', $ruta->id, ['class'=>'form-control']) !!}
                    {!! Form::hidden('nombre_ruta_solicitud', $ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo, ['class'=>'form-control']) !!}
                
                

                    {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}

                {!! Form::close() !!}

                

                </div> 

            </div>
            <hr>
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><strong><i class="fa-solid fa-folder-tree"></i> Crear Sub-Ruta</strong>   </h2>
                    
                </div>

                <div class="card-body" >  
                    {!! Form::open(['url' => '/admin/solicitud_despacho/crear_subruta', 'files' => true]) !!}       
                        {!! Form::hidden('id_solicitud', $idSolicitud, ['class'=>'form-control']) !!}                     
                        {!! Form::hidden('ruta_base', $ruta->id, ['class'=>'form-control']) !!}
                        {!! Form::hidden('nombre_ruta_solicitud', $ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo, ['class'=>'form-control']) !!}

                        

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}

                    {!! Form::close() !!}

                </div> 

            </div>

        </div> 

        <div class="card-footer clearfix">

        </div>

    </div>
</div>

<div class="col-md-9">
    <div class="card ">

        <div class="card-header">
            <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Distribución de la Ruta</strong>   </h2>
            
        </div>

        <div class="card-body" >  
            <div class="row">
                <div class="col-md-4">
                    <div class="card ">

                        <div class="card-header">
                            <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Agregar Escuela a la Sub-Ruta</strong>   </h2>
                            
                        </div>

                        <div class="card-body" >  
                            {!! Form::open(['url' => '/admin/solicitud_despacho/crear_subruta', 'files' => true]) !!}                            
                                
                                    <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Sub-Ruta: </strong></label>
                                    <div class="input-group">           
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        <select name="id_ubicacion" id="id_ubicacion" style="width: 90%" >
                                            @foreach($sub_rutas as $s)
                                                <option value=""></option>
                                                <option value="{{ $s->id }}">{{ $s->nombre}}</option>
                                            @endforeach
                                        </select>            
                                    </div>

                                    <label for="name" class="mtop16"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Escuela: </strong></label>
                                    <div class="input-group">           
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        <select name="id_ubicacion" id="id_escuela" style="width: 90%" >
                                            @foreach($escuelas as $e)
                                                <option value=""></option>
                                                <option value="{{ $e->id }}">{{ $e->codigo.' - '.$e->nombre}}</option>
                                            @endforeach
                                        </select>            
                                    </div>

                                    <label for="name " class="mtop16"> <strong>Orden de Llegada: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::number('orden_llegada', 1, ['class'=>'form-control', 'min'=>'1']) !!}
                                    </div>

                                {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}

                            {!! Form::close() !!}
                        </div> 

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Listado de Sub-Rutas</strong>   </h2>
                        </div>

                        <div class="card-body">
                            <table id="tabla" class="table table-striped table-hover mtop16">
                                <thead>
                                    <tr>
                                        <td><strong> OPCIONES </strong></td>
                                        <td><strong> ESCUELA</strong></td>
                                        <td><strong> SUB-RUTA</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> 

        <div class="card-footer clearfix">

        </div>

    </div>
</div>