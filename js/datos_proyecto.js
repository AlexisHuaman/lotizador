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
        let i_presupuesto_inicial = "";
        let i_presupuesto_actual = "";

        i_nombre += `${data.nombre}`;
        i_presupuesto_inicial += `${data.presupuesto_inicial}`;
        i_presupuesto_actual += `${data.presupuesto_actual}`;
        let template = "";
        template += `
        <div class="card">
            <img
                src="https://img.europapress.es/fotoweb/fotonoticia_20160321145313_800.jpg"
                alt="piloto"
            />
            <p class="description">
                Nombre:${i_nombre} <br/>
                presupuesto inicial:${i_presupuesto_inicial}<br/>
                presupuesto  total:${i_presupuesto_actual}
                
            </p>
        </div>
        `;
        $("#detalle_proyecto").html(template);
        $("#p_nombre").html(i_nombre);
        $("#p_presupuesto_inicial").html(i_presupuesto_inicial);
        $("#p_presupuesto_actual").html(i_presupuesto_actual);
      }
    );
  }
  let id_proyecto = $("#id-proyect").attr("data-id");
  detalles_proyecto(id_proyecto);
});
