$(document).ready(function () {
  console.log("hola proyecto");
  function detalles_proyecto(id) {
    let funcion = "detalles_pro";
    $.post(
      "../controlador/ProyectosController.php",
      { funcion, id },
      (response) => {
        let data = JSON.parse(response);
        console.log(data);

        let i_nombre = "";
        let i_presupuesto = "";

        i_nombre += `${data.nombre}`;
        i_presupuesto += `${data.presupuesto}`;
        let template = "";
        template += `
        <div class="card">
            
            <p class="description">
                Nombre:${i_nombre} <br/>
                presupuesto:${i_presupuesto}
            </p>
        </div>
        `;
        $("#detalle_proyecto").html(template);
        $("#p_nombre").html(i_nombre);
        $("#p_presupuesto").html(i_presupuesto);
      }
    );
  }
  let id_proyecto = $("#id-proyect").attr("data-id");
  detalles_proyecto(id_proyecto);
});
