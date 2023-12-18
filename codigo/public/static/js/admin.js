const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

window.onload = function(){
    loader.style.display = 'none'
}

document.addEventListener('DOMContentLoaded', function(){
    

    btn_eliminar = document.getElementsByClassName('btn-eliminar');
    btn_detalle = document.getElementsByClassName('btn-detalle');
    var btn_generar_usuario = document.getElementById('btn_generar_usuario');
    var btn_buscar_escuelas_despacho = document.getElementById('btn_buscar_escuelas_despacho');

    for(i=0; i < btn_eliminar.length; i++){
        btn_eliminar[i].addEventListener('click', delete_object);
    }

    for(i=0; i < btn_detalle.length; i++){
        btn_detalle[i].addEventListener('click', detalle_object);
        
    }

    if(btn_generar_usuario){
        btn_generar_usuario.addEventListener('click', function(e){
            e.preventDefault();
            setGenerarUsuario();
        });
    } 

    if(btn_buscar_escuelas_despacho){
        btn_buscar_escuelas_despacho.addEventListener('click', function(e){
            e.preventDefault();
            obtenerEscuelas();
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

    $("#id_solicitud").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#rol").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#idinsumo").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });
    
    $("#idEntrega").select2({
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

function obtenerEscuelas(){
    var id_solicitud = document.getElementById('id_solicitud').value;    

    select = document.getElementById('id_escuela');
    select.innerHTML = "";
    //var url = base + '/agem/public/admin/agem/api/load/studies/'+exam;
    var url = base + '/stocksys/api/escuelas/'+id_solicitud;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);            

            if('escuelas' in data){ 
                for(i=0; i<data.escuelas.length; i++){
                    select.innerHTML += "<option value=\""+data.escuelas[i].escuela.id+"\" selected>"+data.escuelas[i].escuela.codigo+" / "+data.escuelas[i].escuela.nombre+"</option>";
                }

            }

            

        }
    }
}


