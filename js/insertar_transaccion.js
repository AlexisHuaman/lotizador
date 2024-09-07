$(document).ready(function () {
  console.log("hola insertar transaccion");

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
        // Procesar la respuesta del servidor
        if (response == "insertado") {
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
