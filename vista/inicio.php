<?php
session_start();
if (!empty($_SESSION['id_usuario'])) {
    $current_path = $_SERVER['REQUEST_URI'];

    $base_path = '/apibilletera/vista/';

    $parts = explode($base_path, $current_path);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/style_usuario.css">
        <link rel="stylesheet" href="../css/main.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Document</title>
    </head>

    <body>
        <div class="">
            <?php
            include_once("../components/layout.php")
            ?>
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

            <ul class="navbar-nav2">
                <li>
                    <a href="perfil.php" class="btn2 btn-logout">Perfil</a>
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
                </div>

                <!-- Formulario de edición, inicialmente oculto -->
                <div id="editFormContainer" style="display: none;">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="edit_nombre">Nombre:</label>
                            <input type="text" id="edit_nombre" name="edit_nombre">
                        </div>
                        <div class="form-group">
                            <label for="edit_correo">Correo:</label>
                            <input type="email" id="edit_correo" name="edit_correo">
                        </div>
                        <div class="form-group">
                            <label for="edit_telefono">Teléfono:</label>
                            <input type="text" id="edit_telefono" name="edit_telefono">
                        </div>
                        <button type="submit" class="save_btn" id="save_btn">Guardar</button>
                    </form>
                </div>
            </div>

            <div id="usuarioContainer">
                <script src="../js/usuario.js"></script>
                <script src="../js/jquery.min.js"></script>
            </div>
        </div>


        </div>
        </div>

    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>