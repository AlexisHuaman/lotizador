$(document).ready(function () {
    console.log("hola transaccion");

    function listarTransacciones(id) {
        let funcion = "lista_transacciones";
        $.post("../controlador/ProyectosController.php", { funcion, id }, (response) => {
            console.log("Raw response:", response); // Esto imprimirá la respuesta cruda
            try {
                let data = JSON.parse(response);
                console.log(data);

                let t_id = '';
                let t_presupuesto = '';
                let t_fecha = '';
                let t_descripcion = '';
                let t_tipo = '';
                // Iterar sobre el arreglo de transacciones
                data.forEach(transaccion => {
                    t_id += `<li>${transaccion.id}</li>`;
                    t_presupuesto += `<li>${transaccion.presupuesto}</li>`;
                    t_fecha += `<li>${transaccion.fecha}</li>`;
                    t_descripcion += `<li>${transaccion.descripcion}</li>`;
                    t_tipo += `<li>${transaccion.nombre}</li>`;
                });
                
                let t_template = "";
                t_template +=`
                <div class="t_transaccion">
                
                <div class="transaccion">
                    <p class="det">Numero: ${t_id}</p>
                </div>
                <div class="transaccion">
                    
                    <p class="det">Tipo: ${t_tipo}</p>
                   
                </div>
                <div class="transaccion">
                    <p class="det">Monto: ${t_presupuesto}</p>
                </div>
                <div class="transaccion">
                    <p class="det">Fecha: ${t_fecha}</p>
                </div>
                <div class="transaccion">
                    <p class="det">Descripcion: ${t_descripcion}</p>
                </div>

                </div>
                `;
                $("#detalle_transaccion").html(t_template);

                // Insertar la lista en el elemento con id 't_lista'
                $('#t_id').html(`<ul>${t_id}</ul>`);
                $('#t_presupuesto').html(`<ul>${t_presupuesto}</ul>`);
                $('#t_fecha').html(`<ul>${t_fecha}</ul>`);
                $('#t_descripcion').html(`<ul>${t_descripcion}</ul>`);
                $('#t_tipo').html(`<ul>${t_tipo}</ul>`);

                } 
                catch (e) {
                console.error("Error al parsear JSON:", e);
                }
            
        });
    }

    // Obtén el ID del proyecto desde el atributo data-id
    let id_proyecto = $("#id-proyect").attr("data-id");
    console.log("ID del Proyecto:", id_proyecto);

    // Llama a la función pasar el ID del proyecto
    listarTransacciones(id_proyecto);
});