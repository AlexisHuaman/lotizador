<?php
// server.php
$port = getenv('PORT') ?: 8080; // Usa el puerto de la variable de entorno o 8080 por defecto
$host = '0.0.0.0'; // Acepta conexiones desde cualquier dirección

// Iniciar un servidor PHP
$server = "php -S $host:$port -t vista"; // Cambia 'vista' si es necesario
system($server);
