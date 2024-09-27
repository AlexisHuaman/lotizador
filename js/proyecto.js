$(document).ready(function () {
  console.log("hola proyecto");

  function detalles_proyecto() {
    let funcion = "detalles_pro";
    let id = 1;
    $.post(
      "../controlador/ProyectosController.php",
      { funcion, id },
      (response) => {
        let data = JSON.parse(response);
        console.log(data);

        // Asignar el nombre del proyecto
        let proyecto_nombre = `${data.nombre}`;

        // Mostrar el nombre del proyecto en el elemento con id 'proyecto_nombre'
        $("#proyecto_nombre").html(proyecto_nombre);
      }
    );
  }
});
