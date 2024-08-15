$(document).ready(function () {
    console.log("hola transaccion");

    function listarTransacciones(id) {
        let funcion = "lista_transacciones";
        $.post("../controlador/ProyectosController.php", { funcion, id }, (response) => {
            console.log("Raw response:", response); // Esto imprimirá la respuesta cruda
            try {
                let data = JSON.parse(response);
                console.log(data);
            } catch (e) {
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