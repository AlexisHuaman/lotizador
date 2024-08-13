$(document).ready(function () {
  console.log("hola inicio");
  function listarProyectos() {
    let funcion = "buscar_proyectos_by_user";
    $.post(
      "../controlador/ProyectosController.php",
      { funcion },
      (response) => {
          let data = JSON.parse(response)
          console.log(data);
      }
    );
  }
  listarProyectos()
});
