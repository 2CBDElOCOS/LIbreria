<?php
// conexion.php

function conectar() {
    $host = 'localhost';
    $usuario = 'root';
    $clave = '';
    $base_datos = 'libreria';

    // Crear conexión
    $conn = new mysqli($host, $usuario, $clave, $base_datos);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}
?>
