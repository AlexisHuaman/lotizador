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

    $(document).on('click','.edit_btn',(e)=>{
        funcion='capturar_datos';
        edit=true;
        $.post('../controlador/UsuarioController.php',{funcion,id_usuario},(response)=>{
            console.log(response);
            const usuario = JSON.parse(response);
            $('#telefono').val(usuario.telefono);
            $('#residencia').val(usuario.residencia);
            $('#correo').val(usuario.correo);
            $('#sexo').val(usuario.sexo);
            $('#adicional').val(usuario.adicional);
        })
    })

    $('#form-usuario').submit(e=>{
        if(edit==true){
            let telefono = $('#telefono').val();
            let residencia = $('#residencia').val();
            let correo = $('#correo').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();
            funcion='editar_usuario';
            $.post('../controlador/usuario_controller.php',{id_usuario,funcion,telefono,residencia,correo,sexo,adicional}, (response)=>{
                if(response=='editado'){
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit=false;
                buscar_usuario(id_usuario);
            })
        }
        else{
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    })
})