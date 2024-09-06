$(document).ready(function () {
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

        // Crear botones para cada proyecto
        data.forEach((proyecto) => {
          let button = $("<button></button>")
            .addClass(
              "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg m-2 w-40 h-40 flex flex-col items-center justify-center"
            ) // Añadir clases TailwindCSS para tamaño y estilo
            .attr("data-id", proyecto.id); // Añadir un atributo personalizado con el ID del proyecto

          // Añadir la imagen (se debe ajustar la lógica para que cada proyecto tenga su imagen correspondiente)
          let imgSrc = `../imagenes/proyecto${proyecto.id}.jpg`; // Ruta de la imagen (ajústala según tu estructura de carpetas)
          let img = $("<img>")
            .attr("src", imgSrc)
            .addClass("w-24 h-24 mb-2 object-contain"); // Ajustar el tamaño de la imagen

          // Añadir el texto (nombre del proyecto)
          let text = $("<span></span>")
            .text(proyecto.nombre)
            .addClass("text-center");

          // Añadir la imagen y el texto al botón
          button.append(img);
          button.append(text);

          // Añadir un evento 'click' al botón
          button.on("click", function () {
            let proyectoId = $(this).attr("data-id");
            // Redirigir a la vista del proyecto con el ID correspondiente
            window.location.href = `../vista/proyecto.php?id=${proyectoId}`;
          });

          // Añadir el botón al contenedor
          $("#proyectosContainer").append(button);
        });
      }
    );
  }

  listarProyectos();
});
