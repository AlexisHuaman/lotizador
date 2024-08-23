<?php
session_start();
if (!empty($_SESSION['id_usuario']))
 {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/style_usuario.css">
        <link rel="stylesheet" href="../css/main.css">
        <title>Document</title>
    </head>

    <body>
        <div class="containerproyectos">
            <h1>Mis proyectos</h1>
            <div id="proyectosContainer" class="btn btn-primary text-center">
                <script src="../js/jquery.min.js"></script>
                <script src="../js/gestion_proyectos.js"></script> 
            </div>
        </div>

        <ul class="navbar-nav2">
            <li>
                <a href="../controlador/logout.php" class="btn2 btn-logout">Cerrar Sesión</a>
            </li>
        </ul>

        <div class="usuario_datos">
        <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
        <h3>Técnico</h3>

        <!-- Tabla para mostrar los datos del usuario -->
        <table class="tabla_usuario">
            <div class="usuario_imagen">
                <img id="imagen_us" src="../imagenes/icono.png" alt="Imagen del usuario">
            </div>
            <tr>
                <th>Nombre</th>
                <td id="nombre_us"></td>
            </tr>
            <tr>
                <th>Correo</th>
                <td id="correo_us"></td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td id="telefono_us"></td>
            </tr>
        </table>
        
        <div class="buttons">
            <button class="edit_btn" id="edit_btn">Editar</button>
            <button class="save_btn" id="save_btn">Guardarxxxxxxxxxxxxxxxxxxx</button>
        </div>

        <div id="usuarioContainer">
            <script src="../js/usuario.js"></script> 
            <script src="../js/jquery.min.js"></script>
        </div>
    </div>
    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>