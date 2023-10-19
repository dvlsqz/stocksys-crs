<div class="modal fade" id="practice_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><strong><i class="fas fa-edit"></i> Edición de Ubicación</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {!! Form::open(['url' => '/admin/ubicacion/editar', 'files' => true]) !!}
                    @include('admin.ubicaciones.formulario')
                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Cerrar</button>
                
            </div>

        </div>
    </div>
</div>


