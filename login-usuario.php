<?php
session_start();
include("conexion.php");

$usuario = trim($_POST['usuario'] ?? '');
$clave   = $_POST['clave'] ?? '';

$stmt = $conexion->prepare("SELECT id, nombre, usuario, clave, tipo_usuario_id FROM usuarios WHERE usuario = ? LIMIT 1");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$reg = $stmt->get_result()->fetch_assoc();

if ($reg && password_verify($clave, $reg['clave'])) {
    session_regenerate_id(true);
    $_SESSION['id']      = $reg['id'];
    $_SESSION['usuario'] = $reg['usuario'];
    $_SESSION['nombre']  = $reg['nombre'];
    $_SESSION['tipo']    = (int)$reg['tipo_usuario_id'];
    $_SESSION['csrf']    = bin2hex(random_bytes(16));
    echo "<script>alert('Bienvenido.');window.location='dashboard.php';</script>";
} else {
    echo "<script>alert('Usuario o clave incorrectos. Intente de nuevo.');window.location='index.html';</script>";
}
