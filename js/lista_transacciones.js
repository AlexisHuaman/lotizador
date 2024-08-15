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
                    transaccionesHTML += `
                    <div class="transaccion">
                        <h3>Transacción ID: ${transaccion.id}</h3>
                        <p><strong>Presupuesto:</strong> ${transaccion.presupuesto}</p>
                        <p><strong>Fecha:</strong> ${transaccion.fecha}</p>
                        <p><strong>Descripción:</strong> ${transaccion.descripcion}</p>
                        <p><strong>Tipo:</strong> ${transaccion.nombre}</p>
                    </div>
                    <hr>
                `;
                });

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