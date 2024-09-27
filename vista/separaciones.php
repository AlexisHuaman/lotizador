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
        <link rel="stylesheet" type="text/css" href="../css/style_usuario.css">
        <link rel="stylesheet" href="../css/main.css">

        <script src="https://cdn.tailwindcss.com"></script>
        <title>Document</title>
    </head>

    <body>
        <?php
        include_once("../components/layout.php")
        ?>


        <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
        <h3>Técnico</h3>

        <!-- Tabla para mostrar los datos del usuario -->
        <table class="tabla_usuario">
            <div class="usuario_imagen">
                <img class="center" id="imagen_us" src="../imagenes/icono.png" alt="Imagen del usuario">
            </div>
            <tr class="grupo">
                <th>Usuario</th>
                <td id="nombre_us"></td>
            </tr>
            <tr class="grupo">
                <th>Numero de celular</th>
                <td id="telefono_us"></td>
            </tr>
            <tr class="grupo">
                <th>Correo</th>
                <td id="correo_us"></td>
            </tr>
        </table>

        <div class="buttons">
            <button class="edit_btn" id="edit_btn">Editar</button>
        </div>

        <!-- Formulario de edición, inicialmente oculto -->
        <div id="editFormContainer" style="display: none;">
            <form id="editForm">
                <div class="form-group">
                    <label for="edit_nombre">Usuario</label>
                    <input type="text" id="edit_nombre" name="edit_nombre">
                </div>

                <div class="form-group">
                    <label for="edit_telefono">Numero de celular</label>
                    <input type="text" id="edit_telefono" name="edit_telefono">
                </div>

                <div class="form-group">
                    <label for="edit_correo">Correo:</label>
                    <input type="email" id="edit_correo" name="edit_correo">
                </div>

                <button type="submit" class="save_btn" id="save_btn">Guardar</button>
            </form>
        </div>


        <!-- Cargar jQuery antes del script que lo utiliza -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/usuario.js"></script>
    </body>

    </html>

<?php
} else {

    header('location: ../vista/index.php');
}
?>