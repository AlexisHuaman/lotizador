<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<?php
session_start();
if(!empty($_SESSION['contrasena_usuario'])){
    header('location: ../controlador/LoginController.php');
}
else{
    session_destroy();
?>
    <body>
    <img class="wave" src="imagenes/wave.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="imagenes/bg.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="../controlador/LoginController.php" method="post">
                <img src="imagenes/logo (1).png" alt="">
                <h2>Billetera</h2>
                
                <div class="input-div correo">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Correo</h5>
                        <input type="text" name="user" class="input">
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="pass" class="input">
                    </div>
                </div>

                <input type="submit" class="btn" value="iniciar sesion">
            </form>
        </div>
    </div>
    </body>
    <script src="js/login.js"></script>
    </html>
<?php
}
?>