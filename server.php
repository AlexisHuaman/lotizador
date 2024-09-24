<?php
// server.php

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar el servidor PHP en el puerto definido por la variable de entorno PORT
$port = getenv('PORT') ?: 8000; // Valor por defecto en caso de que PORT no esté definido
$host = '0.0.0.0'; // Aceptar conexiones desde cualquier IP

// Iniciar el servidor
echo "Servidor PHP corriendo en http://$host:$port\n";
require 'vista/index.php'; // Incluir el archivo index.php