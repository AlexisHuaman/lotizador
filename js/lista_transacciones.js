$(document).ready(function () {
  console.log("hola transaccion");
  var aux_presupuesto = 0;

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
            t_template += `
                <tr>                
                    <td>${index + 1}</td>
                    <td>${t.nombre}</td>
                    <td>S/${Number(t.presupuesto).toFixed(2)}</td>
                    <td>${t.fecha}</td>
                    <td>${t.descripcion}</td>
                </tr>
            `;

            switch (t.tipo_transaccion_id) {
              case 1:
                aux_presupuesto += t.presupuesto;
                break;
              case 2:
                aux_presupuesto -= t.presupuesto;
                break;
              case 3:
                aux_presupuesto += t.presupuesto;
                break;
            }
          });

          $("#detalle_transaccion").html(t_template);

          aux_presupuesto = parseFloat(aux_presupuesto.toFixed(2));
          $("#presupuesto_transiciones").html(aux_presupuesto);

          //presupuesto(id_proyecto, aux_presupuesto);
        } catch (e) {
          console.error("Error al parsear JSON:", e);
        }
      }
    );
  }
  // Llama a la función pasar el ID del proyecto
  listarTransacciones(id_proyecto);

  function detalles_proyecto(id) {
    let funcion = "detalles_pro";
    $.post("../controlador/ProyectosController.php", { funcion, id });
  }

  //   crear una transaccion
  $("#form-transaccion").submit((e) => {
    e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

    // Recoger los valores del formulario
    let presupuesto = $("#t_presupuesto").val();
    let fecha = $("#t_fecha").val();
    let descripcion = $("#t_descripcion").val();
    let tipo = $("#t_tipo").val();
    let id_proyecto = $("#id-proyect").attr("data-id"); // Obtener el ID del proyecto

    // Enviar la solicitud AJAX para insertar la transacción
    $.post(
      "../controlador/TransaccionesController.php",
      {
        funcion: "insertar_transaccion",
        presupuesto,
        fecha,
        descripcion,
        tipo,
        id: id_proyecto,
      },
      (response) => {
        let data = JSON.parse(response);
        console.log(data);
        // Procesar la respuesta del servidor
        if (data == "insertado") {
          listarTransacciones(id_proyecto);
          $("#insertado").hide("slow").show(1000).hide(2000);
          $("#form-transaccion").trigger("reset"); // Resetear el formulario
        } else {
          $("#noinsertado").hide("slow").show(1000).hide(2000);
        }
      }
    );
  });
});
