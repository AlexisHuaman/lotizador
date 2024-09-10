$(document).ready(function () {
  var aux_presupuesto = 0;
  // variables globales de paginacion
  let currentPage = 1;
  let itemsPerPage = parseInt($("#itemsPerPage").val());
  var transacciones;
  var filterTransacciones;
  var imagen;

  var Saldo = 0;
  var Ganancia = 0;
  var Ventas = 0;
  var Inversisones = 0;
  var Gastos = 0;

  // Obtén el ID del proyecto desde el atributo data-id
  let id_proyecto = $("#id-proyect").attr("data-id");

  function loadTransactions(fechaInicio, fechaFin) {
    $.ajax({
      url: "cargar_transacciones.php", // Archivo PHP que maneja la solicitud
      type: "POST",
      dataType: "json",
      data: {
        id_proyecto: id_proyecto,
        fecha_inicio: fechaInicio,
        fecha_fin: fechaFin,
      },
      success: function (data) {
        filterTransacciones = data;
        renderTable(filterTransacciones);
      },
    });
  }

  function renderCharts(data) {
    let proyectosData = {}; // Objeto para almacenar los datos por proyecto
    // Agrupar las transacciones por proyecto
    data.forEach((t) => {
      if (!proyectosData[t.proyecto_id]) {
        proyectosData[t.proyecto_id] = {
          nombre: t.p_nombre,
          inversionTotal: 0,
          gastoTotal: 0,
          ventaTotal: 0,
        };
      }

      // Dependiendo del tipo de transacción, sumar al total correspondiente
      switch (t.tipo_transaccion_id) {
        case 1: // Inversión
          proyectosData[t.proyecto_id].inversionTotal += Number(t.presupuesto);
          break;
        case 2: // Gasto
          proyectosData[t.proyecto_id].gastoTotal += Number(t.presupuesto);
          break;
        case 3: // Venta
          proyectosData[t.proyecto_id].ventaTotal += Number(t.presupuesto);
          break;
      }
    });
    console.log(proyectosData);

    // Limpiar el contenedor de gráficos antes de renderizar
    $("#chart-container").empty();

    // Recorrer proyectosData y crear un gráfico por cada proyecto
    for (let proyecto_id in proyectosData) {
      let proyecto = proyectosData[proyecto_id];

      // Crear un canvas dinámico para el gráfico de este proyecto
      let canvasId = `chart-${proyecto_id}`;
      $("#chart-container").append(`
      <div style="margin-bottom: 10px;">
        <h2>${proyecto.nombre}</h2>
        <canvas id="${canvasId}" style="width: 300px; height: 300px;"></canvas>
      </div>
      `);

      // Crear el gráfico circular para este proyecto
      let ctx = document.getElementById(canvasId).getContext("2d");
      new Chart(ctx, {
        type: "doughnut", // Gráfico circular
        data: {
          labels: ["Inversión", "Gasto", "Venta"], // Etiquetas del gráfico
          datasets: [
            {
              data: [
                proyecto.inversionTotal.toFixed(2),
                proyecto.gastoTotal.toFixed(2),
                proyecto.ventaTotal.toFixed(2),
              ], // Totales de inversión, gasto y venta
              backgroundColor: [
                "rgba(75, 192, 192, 0.2)", // Color de inversión
                "rgba(255, 99, 132, 0.2)", // Color de gasto
                "rgba(54, 162, 235, 0.2)", // Color de venta
              ],
              borderColor: [
                "rgba(75, 192, 192, 1)",
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          responsive: true,
          layout: {
            padding: {
              left: 50,
              right: 50,
              top: 10,
              bottom: 50,
            },
          },

          plugins: {
            legend: {
              position: "top", // Posición de la leyenda
            },
          },
        },
      });
    }
  }

  function renderTable(data) {
    let start = (currentPage - 1) * itemsPerPage;
    let end = start + itemsPerPage;
    let paginatedItems = data.slice(start, end);
    console.log("Items por pagina:", itemsPerPage);
    console.log("pagina de items:", paginatedItems);
    console.log("Start:", start);
    console.log("End", end);

    // Limpiar la tabla antes de renderizar
    //$("#detalle_transaccion").empty();

    // Renderizar las filas de la tabla
    let t_template = "";

    paginatedItems.forEach((t, index) => {
      t_template = `
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
          Saldo += t.presupuesto;
          Inversisones += t.presupuesto;
          break;

        case 2:
          Saldo -= t.presupuesto;
          Ganancia -= t.presupuesto;
          Gastos += t.presupuesto;
          break;

        case 3:
          Saldo += t.presupuesto;
          Ventas += t.presupuesto;
          Ganancia += t.presupuesto;
          break;
      }

      $("#detalle_transaccion").append(t_template);
    });
    renderPagination(data);
    //renderCharts(imagen);
  }

  function renderPagination(data) {
    let totalPages = Math.ceil(data.length / itemsPerPage);
    console.log(totalPages);
    let pagination = $(".pagination");

    pagination.empty();

    pagination.append(`
          <li class="page-item ${
            currentPage === 1 ? "bg-gray-200" : "bg-white"
          }">
              <button class="page-link rounded text-sm font-bold px-3 py-2" id="prevPage">Previous</button>
          </li>
      `);

    for (let i = 1; i <= totalPages; i++) {
      pagination.append(`
              <li class="page-item ${
                i === currentPage ? "bg-blue-500 text-white" : "bg-white "
              }">
                  <button class="page-link rounded text-sm font-bold px-3 py-2" data-page="${i}">${i}</button>
              </li>
          `);
    }

    pagination.append(`
          <li class="page-item ${
            currentPage === totalPages ? "bg-gray-200" : "bg-white"
          }">
              <button class="page-link rounded text-sm font-bold px-3 py-2"  id="nextPage">Next</button>
          </li>
      `);
  }

  // Botón "Previous"
  $(document).on("click", "#prevPage", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      renderTable(transacciones);
    }
  });

  // Botón "Next"
  $(document).on("click", "#nextPage", function (e) {
    e.preventDefault();
    let totalPages = Math.ceil(transacciones.length / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderTable(transacciones);
    }
  });

  // Manejo de cambio en el menú desplegable de items por página
  $("#itemsPerPage").change(function () {
    itemsPerPage = parseInt($(this).val());
    currentPage = 1;
    renderTable(transacciones);
  });

  $("#reset").click(function () {
    filterTransacciones = transacciones;
    renderTable(filterTransacciones);
    $("input[name='fecha_inicio']").val("");
    $("input[name='fecha_fin']").val("");
  });

  $("#filtrar-reporte").click(function () {
    let fechaInicio = $("input[name='fecha_inicio']").val();
    let fechaFin = $("input[name='fecha_fin']").val();
    console.log(fechaFin);
    loadTransactions(fechaInicio, fechaFin);
  });

  $("#descargar-reporte").click(function (event) {
    // Capturar el contenido de la tabla
    // Pasar el contenido al campo oculto
    $("#tabla_transacciones").val(JSON.stringify(transacciones));
  });

  // Manejo de clic en paginación
  $(document).on("click", ".pagination button.page-link", function (e) {
    e.preventDefault();
    let page = $(this).data("page");
    if (page) {
      currentPage = page;
      renderTable(transacciones);
    }
  });

  function listarTransacciones(id) {
    let funcion = "lista_transacciones";
    $.post(
      "../controlador/ProyectosController.php",
      { funcion, id },
      (response) => {
        console.log("Raw response:", response); // Esto imprimirá la respuesta cruda
        try {
          let data = JSON.parse(response);
          transacciones = data;
          imagen = data;
          filterTransacciones = data;
          console.log(data);
          renderTable(data);

          aux_presupuesto = parseFloat(aux_presupuesto.toFixed(2));
          $("#presupuesto_transiciones").html(aux_presupuesto);
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

  //---------------------------Crear una transaccion-------------------------------
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
