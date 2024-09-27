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

<div id="sidebar" class="w-[200px] -translate-x-[400px] md:translate-x-[0px] transition duration-300 fixed top-0 left-0 bottom-0 bg-blue-900">
    <div class="w-full flex flex-col items-center justify-center my-10">
        <img class="rounded-full w-[80px] h-[80px] object-cover" src="../imagenes/icono.png" alt="">
        <p class="text-white text-sm ">[nombre user]</p>
    </div>
    <!-- navegacion -->
    <ul class="w-full flex flex-col gap-2 px-8">
        <a href="proyecto.php" class="w-full <?php echo $parts[1] == "proyecto.php" ? "bg-white text-blue " : "" ?> rounded p-3">Proyecto</a>

        <a href="asesores.php" class="w-full <?php echo $parts[1] == "asesores.php" ? "bg-white text-blue " : "" ?> rounded p-3">Asesores</a>

        <a href="ventas.php" class="w-full <?php echo $parts[1] == "ventas.php" ? "bg-white text-blue " : "" ?> rounded p-3">Ventas</a>

        <a href="separaciones.php" class="w-full <?php echo $parts[1] == "separaciones.php" ? "bg-white text-blue " : "" ?> rounded p-3">Separaciones</a>
    </ul>
    <div class="logout px-8 mt-12">
        <a href="../controlador/logout.php" class="inline-block text-white w-full bg-black rounded p-3">Cerrar Sesion</a>
    </div>

</div>
<div class="bg-black pl-[0px] md:pl-[200px] text-white">hola</div>
<div class="layout pl-[20px] md:pl-[220px] pr-[20px] transition duration-300 overflow-auto">