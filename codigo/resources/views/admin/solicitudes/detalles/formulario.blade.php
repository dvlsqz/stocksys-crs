<div class="row">
    <div class="col-md-12">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Escuela: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
            {!! Form::select('id_escuela', $escuelas,$detalles->id_escuela,['class'=>'form-select']) !!}
        </div>
    </div>  

    <div class="col-md-6 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Mes de la Solicitud: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->mes_de_solicitud, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Dias de la Solicitud: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->dias_de_solicitud, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Niñas Preprimaria a Tercero Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->ninas_pre_primaria_a_tercero_primaria, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Niños Preprimaria a Tercero Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->ninos_pre_primaria_a_tercero_primaria, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total Preprimaria a Tercero Primaria: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_pre_primaria_a_tercero_primaria, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Niñas Cuarto a Sexto Primatia: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->ninas_cuarto_a_sexto, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Niños Cuarto a Sexto Primatia: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->ninos_cuarto_a_sexto, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total Cuarto a Sexto Primatia: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_cuarto_a_sexto, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Estudiantes: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_de_estudiantes, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total Raciones de Estudiantes: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_de_raciones_de_estudiantes, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Docentes: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_docentes, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Voluntarios: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_voluntarios, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Docentes y Voluntarios: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_de_docentes_y_voluntarios, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total Raciones de Docentes y Voluntarios: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_de_raciones_de_docentes_y_voluntarios, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Personas: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_de_personas, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Raciones: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->total_de_raciones, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-12 mtop16">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo de Actividad Alimentos: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
            {!! Form::select('tipo_alimentos', $raciones,$detalles->tipo_alimentos,['class'=>'form-select']) !!}
        </div>
    </div>  

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Numero de Entrega: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->numero_de_entrega, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4 mtop16 ">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::text('codigo', $detalles->tipo, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>