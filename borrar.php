<?php
include "session.php";
include "conexion.php";
include "inc/modulos.php";
[$m, $mod] = modulo_actual();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
    http_response_code(400); exit('Solicitud inválida.');
}
$id = (int)($_POST['id'] ?? 0);

if ($m === 'usuarios' && $id === (int)$_SESSION['id']) {
    $_SESSION['msg'] = ['warning', 'No puede eliminar su propio usuario.'];
} else {
    try {
        $st = $conexion->prepare("DELETE FROM `$m` WHERE id = ?");
        $st->bind_param("i", $id);
        $st->execute();
        $_SESSION['msg'] = ['success', 'Registro eliminado.'];
    } catch (mysqli_sql_exception $e) {
        $_SESSION['msg'] = ['danger', $e->getCode() == 1451
            ? 'No se puede eliminar: tiene registros relacionados en otras tablas.'
            : 'No se pudo eliminar: ' . $e->getMessage()];
    }
}
header("Location: listado.php?m=$m");
