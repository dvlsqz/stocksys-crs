<label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Insumo: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::select('id_insumo', $insumos, 0,['class'=>'form-select', 'id' => 'id_institucion', 'style' => 'width: 90%']) !!}
</div>