$(document).ready(function () {
  console.log("hola inicio");
  function listarProyectos() {
    let funcion = "buscar_proyectos_by_user";
    $.post(
      "../controlador/ProyectosController.php",
      { funcion },
      (response) => {
        let data = JSON.parse(response);
        console.log(data);
        $("#proyectosContainer").empty();
        let nombre_pro = "";
        data.forEach((proyecto) => {
          let button = $("<button></button>")
            .text(proyecto.nombre) // Establece el texto del botón con el nombre del proyecto
            .attr("data-id", proyecto.id) // Establece un atributo data-id con el ID del proyecto
            .addClass("btn btn-primary proyecto-boton"); // Añadir clases para dar estilo al botón

          // Agregar el botón al contenedor en el DOM
          $("#proyectosContainer").append(button);
        });

        $("#proyectosContainer").on("click", ".proyecto-boton", function () {
          // Obtener el ID del proyecto desde el atributo data-id del botón
          let proyectoId = $(this).attr("data-id");

          // Redirigir a la vista del proyecto con el ID correspondiente
          window.location.href = `../vista/proyecto.php?id=${proyectoId}`;
        });
      }
    );
  }
  listarProyectos();
});
