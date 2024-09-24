<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billetera - Login</title>
    <link rel="stylesheet" type="text/css" href="../css/style_login.css">
    <!-- Asegúrate de incluir Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    echo "Hola, mundo desde PHP!";
    if (!empty($_SESSION['id_usuario'])) {
        header('location: ../controlador/LoginController.php');
    } else {
        session_destroy();
    ?>

        <div class="contenedor">
            <div class="logo-container">
                <img id="imagen_us" src="../imagenes/logo.jpg" alt="Logo de Billetera" class="logo">
            </div>
            <div class="contenido-login">
                <form action="../controlador/LoginController.php" method="post">
                    <h2 class="titulo">Billetera</h2>

                    <div class="input-div correo">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <input type="text" name="user" class="input" placeholder="Correo" required>
                        </div>
                    </div>

                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <input type="password" name="pass" class="input" placeholder="Password" required>
                        </div>
                    </div>

                    <input type="submit" class="btn" value="Iniciar sesión">
                </form>
            </div>
        </div>

    <?php
    }
    ?>
</body>

</html>