$(document).ready(function () {
    console.log("hola transaccion");
    function listarTransacciones(id){
        let funcion = "lista_transacciones";
        $.post("../controlador/ProyectosController.php",{ funcion, id },(response) => 
            {
                let data = JSON.parse(response)
                console.log(data);
      
            }
        )
    }
    listarTransacciones()
  })