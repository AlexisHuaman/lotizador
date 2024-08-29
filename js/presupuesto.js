$(document).ready(function () {
    var aux_presupuesto=0;
    // Obtén el ID del proyecto desde el atributo data-id
    let id_proyecto = $("#id-proyect").attr("data-id");
    console.log("ID del Proyecto:", id_proyecto);
    function listarTransacciones(id) {
      let funcion = "lista_transacciones";
      $.post(
        "../controlador/ProyectosController.php",
        { funcion, id },
        (response) => {
          console.log("Raw response:", response); // Esto imprimirá la respuesta cruda
          try {
            let data = JSON.parse(response);
            console.log(data);
            // Iterar sobre el arreglo de transacciones
            let t_template = "";
            data.forEach((t, index) => {
                t_template += ``;
                aux_presupuesto += t.presupuesto;
            });
  
            $("#presupuesto_transiciones").html(aux_presupuesto);
  
          } catch (e) {
            console.error("Error al parsear JSON:", e);
          }
        }
      );
    }
    // Llama a la función pasar el ID del proyecto
    listarTransacciones(id_proyecto);
    
  });