var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

window.onload = function(){
    loader.style.display = 'none'
}

document.addEventListener('DOMContentLoaded', function(){
    

    btn_eliminar = document.getElementsByClassName('btn-eliminar');
    var btn_generar_usuario = document.getElementById('btn_generar_usuario');

    for(i=0; i < btn_eliminar.length; i++){
        btn_eliminar[i].addEventListener('click', delete_object);
    }

    if(btn_generar_usuario){
        btn_generar_usuario.addEventListener('click', function(e){
            e.preventDefault();
            setGenerarUsuario();
        });
    }

    $('#tabla').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        language: {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });     

    $('#tabla-carga-datos').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        scrollX: true,
        "autoWidth": false,
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"},
          {
            targets: 1,
            width: 1,
          }
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });     

    $("#id_ubicacion").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_institucion").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_escuela").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#rol").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
      });
      
      // make it as accordion for smaller screens
      if ($(window).width() < 992) {
        $('.dropdown-menu a').click(function(e){
          e.preventDefault();
            if($(this).next('.submenu').length){
              $(this).next('.submenu').toggle();
            }
            $('.dropdown').on('hide.bs.dropdown', function () {
           $(this).find('.submenu').hide();
        })
        });
      }

});

function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');     
    var url = base + '/' + path + '/' + object + '/' + action;
    var title, text, icon;

    var contra_prede = document.getElementById('contra_prede');
    var pin_prede = document.getElementById('pin_prede');

    //console.log(url);

    if(action == "eliminar"){
        title = "¿Esta seguro de eliminar este elemento?";
        text = "Recuerde que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }else if(action == "rest-contra"){
        title = "¿Esta seguro de restablecer la Contraseña de Inicio de Sesión a este usuario?";
        text = "Si acepta la contraseña sera: "+contra_prede.value;
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }else if(action == "rest-pin"){
        title = "¿Esta seguro de restablecer el Pin de Autorizaciones a este usuario?";
        text = "Si acepta el pin sera: "+pin_prede.value;
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }


}

function setGenerarUsuario(){
    var p_nombre = document.getElementById('p_nombre');
    var s_nombre  = document.getElementById('s_nombre');
    var p_apellido = document.getElementById('p_apellido');
    var frm_usuario = document.getElementById('frm_usuario');

    var seg_nombre = s_nombre.value;
    var inicial_seg_nombre = seg_nombre.charAt(0);

    var usuario = p_nombre.value+'.'+p_apellido.value;

    var usuario_opcional = p_nombre.value + inicial_seg_nombre + '.' + p_apellido.value;

    frm_usuario.value = usuario.toLowerCase();

    //console.log(usuario_opcional.toLowerCase());
    

}