<?php
session_start();
if(!empty($_SESSION['id_usuario'])){
    echo 'llego hasta vista/inicio/if';
}
else{
    
    header('location: ../vista/index.php');
}
echo 'llego hasta vista/inicio';
?>