<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conexion = new mysqli('localhost', 'root', '', 'beauty_store');
    $conexion->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    exit("Lo sentimos, este sitio web está experimentando problemas. Error de conexión: " . $e->getMessage());
}
