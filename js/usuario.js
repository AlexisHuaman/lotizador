$(document).ready(function(){
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    var edit=false;
    console.log("ID Usuario: ", id_usuario);
    //console.log("ID Usuario: ", id_usuario.nombre_us);
    
    buscar_usuario(id_usuario);

    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        $.post('../controlador/UsuarioController.php',{dato, funcion}, (response) =>{          
            console.log(response);

            let nombres = '';
            let correo = '';
            let telefono = '';

            const usuario = JSON.parse(response);

            nombres += `${usuario.u_nombre}`;
            correo += `${usuario.u_correo}`;
            telefono += `${usuario.u_telefono}`;

            $('#nombre_us').html(nombres);
            $('#correo_us').html(correo);
            $('#telefono_us').html(telefono);
        })
    }

    $(document).ready(function() {
        // Mostrar el formulario de edición al hacer clic en "Editar"
        $('#edit_btn').click(function() {
            $('#editFormContainer').show();
            $('#edit_btn').hide();
            $('#save_btn').show();
    
            // Cargar los datos actuales en el formulario de edición
            $('#edit_nombre').val($('#nombre_us').text());
            $('#edit_correo').val($('#correo_us').text());
            $('#edit_telefono').val($('#telefono_us').text());
        });
    
        // Manejar la acción de guardar los cambios
        $('#editForm').submit(function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe de manera tradicional
    
            // Obtener los valores editados
            var id_usuario = $('#id_usuario').val();
            var nombre = $('#edit_nombre').val();
            var correo = $('#edit_correo').val();
            var telefono = $('#edit_telefono').val();
    
            // Enviar los datos editados al servidor mediante AJAX
            $.post('../controlador/UsuarioController.php', {
                id_usuario: id_usuario,
                nombre: nombre,
                correo: correo,
                telefono: telefono,
                funcion: 'editar_usuario' // Define esta función en tu controlador PHP
            }, function(response) {
                if (response === 'editado') {
                    // Actualizar la vista con los nuevos datos
                    $('#nombre_us').text(nombre);
                    $('#correo_us').text(correo);
                    $('#telefono_us').text(telefono);
    
                    // Ocultar el formulario de edición
                    $('#editFormContainer').hide();
                    $('#edit_btn').show();
                    $('#save_btn').hide();
                } else {
                    alert('Hubo un error al editar el usuario.');
                }
            });
        });
    });

    $(document).ready(function() {
        // Variable edit se debe definir fuera del submit si quieres que su valor sea persistente.
        var edit = false;
        var id_usuario = $('#id_usuario').val();  // Asegúrate de que este campo existe y tiene un valor.
    
        // Maneja el evento submit del formulario
        $('#form-usuario').submit(e => {
            e.preventDefault();  // Evita el envío del formulario por defecto
    
            // Comprueba si está en modo de edición
            if (edit == true) {
                // Obtén los valores de los campos del formulario
                let telefono = $('#telefono').val();
                let correo = $('#correo').val();    
                // Define la función que se enviará al controlador
                let funcion = 'editar_usuario';
    
                // Realiza la solicitud AJAX para editar el usuario
                $.post('../controlador/usuario_controller.php', {
                    id_usuario,
                    funcion,
                    telefono,
                    residencia,
                    correo,
                    sexo,
                    adicional
                }, response => {
                    // Comprueba la respuesta del servidor
                    if (response == 'editado') {
                        // Muestra un mensaje de éxito si la edición fue exitosa
                        $('#editado').hide('slow').show(1000).hide(2000);
                        $('#form-usuario').trigger('reset');  // Reinicia el formulario
                    } else {
                        // Maneja cualquier otra respuesta del servidor
                        alert('Error al editar el usuario');
                    }
                    // Resetea el modo de edición
                    edit = false;
    
                    // Vuelve a buscar los datos del usuario para actualizar la vista
                    buscar_usuario(id_usuario);
                });
            } else {
                // Muestra un mensaje si no está en modo de edición
                $('#noeditado').hide('slow').show(1000).hide(2000);
                $('#form-usuario').trigger('reset');  // Reinicia el formulario
            }
        });
    });
})