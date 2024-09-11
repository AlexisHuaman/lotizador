$(document).ready(function () {
  // Variable para almacenar el tipo de transacción seleccionado
  let tipoTransaccion = $("#t_tipo").val(); // Valor inicial al cargar la página

  // Escuchar cambios en el select de tipo de transacción
  $("#t_tipo").on("change", function () {
    tipoTransaccion = $(this).val(); // Actualizar la variable cuando se selecciona un nuevo valor
    listarCategorias(); // Actualizar las categorías cada vez que se cambie el tipo
  });

  // Función para listar las categorías basadas en el tipo de transacción
  function listarCategorias() {
    let funcion = "categoria_transaccion";
    $.post(
      "../controlador/TransaccionesController.php",
      { funcion, tipo: tipoTransaccion }, // Enviar el tipo de transacción junto con la función
      (response) => {
        let data = JSON.parse(response);

        // Limpiar el contenedor
        $("#categoriasContainer").empty();

        // Crear el elemento <select>
        let select = $("#categoriasContainer");

        // Crear una opción por defecto
        let defaultOption = $("<option></option>")
          .attr("value", "")
          .text("Selecciona una categoría")
          .attr("disabled", true)
          .attr("selected", true);
        select.append(defaultOption);

        // Crear opciones para cada categoría
        data.forEach((categoria) => {
          let option = $("<option></option>")
            .attr("value", categoria.id)
            .text(categoria.nombre); // Usar el nombre de la categoría para el texto de la opción

          // Añadir la opción al <select>
          select.append(option);
        });

        // Evento change para redirigir a la categoría seleccionada
        select.on("change", function () {
          let categoriaId = $(this).val();
          console.log("Categoría seleccionada:", categoriaId);
        });
      }
    );
  }

  // Llamar la función por primera vez para listar las categorías inicialmente
  listarCategorias();
});
