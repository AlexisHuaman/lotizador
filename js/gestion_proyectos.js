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

        // Limpiar el contenedor
        $("#proyectosContainer").empty();

        // Crear el elemento <select>
        let select = $("<select></select>")
          .attr("id", "proyectosSelect") // Añadir un id para el select
          .addClass("form-control"); // Añadir clases para el estilo del select

        // Crear la opción por defecto
        select.append(
          $("<option></option>")
            .text("Seleccione un proyecto")
            .attr("value", "")
        );

        // Crear opciones para cada proyecto
        data.forEach((proyecto) => {
          let option = $("<option></option>")
            .text(proyecto.nombre) // Establece el texto de la opción con el nombre del proyecto
            .attr("value", proyecto.id); // Establece el valor de la opción con el ID del proyecto

          select.append(option); // Añadir la opción al select
        });

        // Agregar el select al contenedor en el DOM
        $("#proyectosContainer").append(select);

        // Manejar el cambio de selección
        $("#proyectosSelect").on("change", function () {
          // Obtener el ID del proyecto seleccionado
          let proyectoId = $(this).val();

          if (proyectoId) {
            // Redirigir a la vista del proyecto con el ID correspondiente
            window.location.href = `../vista/proyecto.php?id=${proyectoId}`;
          }
        });
      }
    );
  }

  listarProyectos();
});
