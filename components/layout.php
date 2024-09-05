<?php
// Obtener la ruta actual y procesarla
$current_path = $_SERVER['REQUEST_URI'];
$base_path = '/apibilletera/vista/';
$relativePath = '';

if (strpos($current_path, $base_path) !== false) {
    $relativePath = strstr($current_path, $base_path);
    $relativePath = substr($relativePath, strlen($base_path)); // Elimina la parte base
}
$relativePath = trim($relativePath, '/'); // Elimina cualquier barra adicional
?>

<div id="sidebar" class="w-[400px] -translate-x-[400px] md:translate-x-[0px] transition duration-300 absolute top-0 left-0 h-[100vh] bg-blue-900">
    <div class="w-full flex flex-col items-center justify-center my-10">
        <img class="rounded-full w-[80px] h-[80px] object-cover" src="../imagenes/icono.png" alt="">
        <p class="text-white text-sm ">[nombre user]</p>
    </div>
    <!-- navegacion -->
    <ul class="w-full flex flex-col gap-4 px-8">
        <a href="inicio.php" class="w-full <?php echo $parts[1] == "inicio.php" ? "bg-white text-blue " : "" ?> rounded p-3">Dashboard</a>
    </ul>

    <div class="w-full flex flex-col padding-5 px-8" id="proyectosContainer"">
        <script src=" ../js/jquery.min.js">
        </script>
        <script src="../js/gestion_proyectos.js"></script>
    </div>

    <ul class="w-full flex flex-col gap-4 px-8">
        <a href="perfil.php" class="w-full <?php echo $parts[1] == "perfil.php" ? "bg-white text-blue " : "" ?> rounded p-3">Perfil</a>
    </ul>
    <div class="logout px-8 mt-12">

        <a href="#" class="inline-block text-white w-full bg-black rounded p-3">Cerrar Sesion</a>
    </div>

</div>
<div class="bg-black pl-[0px] md:pl-[400px] text-white">hola</div>
<div class="layout pl-[0px] md:pl-[400px] transition duration-300">