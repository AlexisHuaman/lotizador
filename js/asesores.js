$(document).ready(function () {
  function listarAsesores() {
    let funcion = "lista_asesores";
    let id = 1;
    $.post(
      "../controlador/AsesoresController.php",
      { funcion, id }, // Enviar el tipo de transacción junto con la función
      (response) => {
        console.log(response);
        let data = JSON.parse(response);
        console.log(data);

        // Limpiar el contenedor
        $("#asesoresContainer").empty();

        // Crear botones para cada categoría
        data.forEach((asesores) => {
          let button = $("<button></button>")
            .addClass(
              "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg m-2 w-40 h-40 flex flex-col items-center justify-center"
            )
            .attr("data-id", asesores.id);

          // Añadir la imagen (dependiendo de la categoría)
          let imgSrc = `../imagenes/asesores/asesores${asesores.id}.jpg`;
          let img = $("<img>")
            .attr("src", imgSrc)
            .addClass("w-24 h-24 mb-2 object-contain");

          // Añadir el texto de la categoría
          let text = $("<span></span>")
            .text(asesores.nombre)
            .addClass("text-center");

          // Añadir la imagen y el texto al botón
          button.append(img);
          button.append(text);

          // Añadir el botón al contenedor
          $("#asesoresContainer").append(button);
        });
      }
    );
  }
  // Llamar la función por primera vez para listar las categorías inicialmente
  listarAsesores();

  // Mostrar el formulario para crear una nueva categoría cuando se presiona el botón
  $("#crearCategoriaBtn").on("click", function () {
    $("#nuevaCategoriaForm").toggle(); // Alternar la visibilidad del formulario
  });

  // Manejar el envío del formulario de nueva categoría
  $("#submitCategoria").on("click", function () {
    // Obtener los valores del formulario
    var nombreCategoria = $("#nombreCategoria").val();
    var tipoCategoria = $("#tipoCategoria").val();
    console.log(nombreCategoria);
    console.log(tipoCategoria);
    if (nombreCategoria === "") {
      alert("Por favor, ingresa el nombre de la categoría.");
      return;
    }

    // Enviar los datos al servidor vía AJAX
    // Enviar los datos editados al servidor mediante AJAX
    $.post(
      "../controlador/TransaccionesController.php",
      {
        nombreCategoria: nombreCategoria,
        tipoCategoria: tipoCategoria,
        funcion: "crear_categoria", // Define esta función en tu controlador PHP
      },
      function (response) {
        let data = JSON.parse(response);
        if (data == "Categoria_creada") {
          // Ocultar el formulario de edición
          $("#nuevaCategoriaForm").hide();
          $("#crearCategoriaBtn").show();
          $("#save_btn").hide();
        } else {
          alert("Hubo un error al crear la categoria.");
          console.log(data);
        }
      }
    );
  });
});
