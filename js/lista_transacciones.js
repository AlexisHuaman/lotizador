$(document).ready(function () {
  var aux_presupuesto = 0;
  // variables globales de paginacion
  let currentPage = 1;
  let itemsPerPage = parseInt($("#itemsPerPage").val());
  var transacciones;
  var filterTransacciones;

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

  // Inicializa el gráfico como una variable global
  let transaccionChart = null;

  function renderChart(data) {
      let labels = [];
      let presupuestos = [];

      data.forEach((t, index) => {
          labels.push(t.nombre); // Los nombres serán las etiquetas del gráfico
          presupuestos.push(Number(t.presupuesto).toFixed(2)); // Los presupuestos serán los valores de las barras
      });

      // Si ya hay un gráfico, destrúyelo para evitar la superposición
      if (transaccionChart) {
          transaccionChart.destroy();
      }

      // Obtener el contexto del canvas
      let ctx = document.getElementById('transaccionChart').getContext('2d');

      // Crear el gráfico de barras
      transaccionChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: labels,
              datasets: [{
                  label: 'Presupuesto',
                  data: presupuestos,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de las barras
                  borderColor: 'rgba(75, 192, 192, 1)', // Color del borde de las barras
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true // Comienza el eje y en 0
                  }
              }
          }
      });
  }

  function renderTable(data) {
    let start = (currentPage - 1) * itemsPerPage;
    let end = start + itemsPerPage;
    let paginatedItems = data.slice(start, end);

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
    renderChart(paginatedItems);
    renderPagination(data);
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
