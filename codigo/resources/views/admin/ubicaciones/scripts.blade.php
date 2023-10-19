<script type="text/javascript">
    $('body').on('click', '#formularioEditar', function (event) {
        
        event.preventDefault();
        var id = $(this).data('id');
        console.log(id);

        $.get('/admin/ubicacion/' + id + '/editar', function (data) {
            console.log(data.ubicacion.nombre);
            $('#nombre').val(data.ubicacion.nombre);
     })

    });
</script>
