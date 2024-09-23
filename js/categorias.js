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
    console.log(tipoTransaccion);
    $.post(
      "../controlador/TransaccionesController.php",
      { funcion, tipo: tipoTransaccion }, // Enviar el tipo de transacción junto con la función
      (response) => {
        console.log(response);
        let data = JSON.parse(response);
        console.log(data);

        // Limpiar el contenedor
        $("#categoriasContainer").empty();

        // Crear botones para cada categoría
        data.forEach((categoria) => {
          let button = $("<button></button>")
            .addClass(
              "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg m-2 w-40 h-40 flex flex-col items-center justify-center"
            )
            .attr("data-id", categoria.id);

          // Añadir la imagen (dependiendo de la categoría)
          let imgSrc = `../imagenes/categorias/categoria${categoria.id}.png`;
          let img = $("<img>")
            .attr("src", imgSrc)
            .addClass("w-24 h-24 mb-2 object-contain");

          // Añadir el texto de la categoría
          let text = $("<span></span>")
            .text(categoria.nombre)
            .addClass("text-center");

          // Añadir la imagen y el texto al botón
          button.append(img);
          button.append(text);

          /*/ Evento click para mostrar el gráfico en un rectángulo a la derecha
          button.on("click", function () {
            let categoriaId = $(this).attr("data-id");

            // Mostrar el contenedor del gráfico
            $("#graficoContainer").removeClass("hidden").addClass("flex");

            // Llamar a la función que genera el gráfico con la categoría seleccionada
            generarGraficoBarras(categoriaId);
          });

          // Añadir el botón al contenedor
          $("#categoriasContainer").append(button);*/

          // Añadir el botón al contenedor
          $("#categoriasContainer").append(button);

          // Crear y ocultar el gráfico para esta categoría
          generarGraficoBarras(categoria.id, button);
        });
      }
    );
  }
  // Llamar la función por primera vez para listar las categorías inicialmente
  listarCategorias();

  // Función que genera el gráfico de barras
  function generarGraficoBarras(categoriaId, button) {
    // Crear un nuevo canvas para el gráfico (oculto al principio)
    let graficoContainer = $("<div></div>")
      .addClass("hidden ml-4 flex items-center justify-center")
      .attr("id", `graficoContainer-${categoriaId}`);
    let graficoCanvas = $("<canvas></canvas>")
      .attr("id", `graficoCanvas-${categoriaId}`)
      .attr("width", "400")
      .attr("height", "150");
    graficoContainer.append(graficoCanvas);
    button.after(graficoContainer); // Añadir el gráfico al lado del botón

    // Hacer una llamada AJAX para obtener las transacciones de la categoría seleccionada
    $.post(
      "../controlador/TransaccionesController.php",
      {
        funcion: "obtenerTransaccionesPorCategoria",
        categoria_id: categoriaId,
      },
      (response) => {
        console.log(response);
        let transacciones = JSON.parse(response);
        let presupuestoxcategoria = 0;

        // Corrección en el forEach: ahora iteramos sobre cada transacción.
        transacciones.forEach((transaccion) => {
          console.log(transaccion.presupuesto); // Correcto acceso a cada presupuesto
          presupuestoxcategoria += parseFloat(transaccion.presupuesto); // Asegúrate de sumar correctamente como número
        });

        console.log(presupuestoxcategoria);

        // Si ya existe un gráfico, lo destruimos antes de crear uno nuevo
        if (window.myBarChart) {
          window.myBarChart.destroy();
        }

        // Crear el gráfico de línea horizontal
        let ctx = document
          .getElementById(`graficoCanvas-${categoriaId}`)
          .getContext("2d");

        window[`myBarChart-${categoriaId}`] = new Chart(ctx, {
          type: "line",
          data: {
            labels: ["Categoría " + categoriaId], // Etiqueta única para la categoría
            datasets: [
              {
                label: "Presupuesto",
                data: [presupuestoxcategoria],
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 2,
                fill: false, // No rellenar debajo de la línea
                tension: 0, // Línea recta
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                display: false, // Ocultamos el eje Y
              },
              x: {
                display: true, // Mostrar el eje X
              },
            },
            plugins: {
              legend: {
                display: false, // Ocultamos la leyenda
              },
            },
          },
        });

        // Evento click para mostrar el gráfico oculto
        button.on("click", function () {
          $(`#graficoContainer-${categoriaId}`).toggleClass("hidden");
        });
      }
    );
  }

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
