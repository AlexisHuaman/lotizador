<?php
// server.php

// Habilitar el manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir el puerto si no está definido
$port = isset($_SERVER['PORT']) ? $_SERVER['PORT'] : 8080;

// Iniciar el servidor embebido
$host = '0.0.0.0';
$docRoot = 'htdocs'; // Cambia esto a tu directorio de documentos, si es diferente
$command = "php -S $host:$port -t $docRoot";

system($command);
