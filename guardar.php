<?php
include "session.php";
include "conexion.php";
include "inc/modulos.php";
[$m, $mod] = modulo_actual();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
    http_response_code(400); exit('Solicitud inválida.');
}
$id = (int)($_POST['id'] ?? 0);

$cols = []; $vals = []; $tipos = '';
foreach ($mod['campos'] as $campo => $c) {
    $v = trim($_POST[$campo] ?? '');
    if (!empty($c['req']) && $v === '' && !($c['tipo'] === 'password' && $id)) {
        $_SESSION['msg'] = ['danger', "El campo «{$c['label']}» es obligatorio."];
        header("Location: form.php?m=$m" . ($id ? "&id=$id" : '')); exit;
    }
    if ($c['tipo'] === 'password') {
        if ($v === '') continue;                        // al editar, vacío = no cambiar la clave
        $v = password_hash($_POST[$campo], PASSWORD_DEFAULT);
    }
    if ($v === '' ) $v = null;
    $cols[] = $campo; $vals[] = $v;
    $tipos .= in_array($c['tipo'], ['number','select']) ? 'i' : ($c['tipo'] === 'decimal' ? 'd' : 's');
}

try {
    if ($id) {
        $set = implode(", ", array_map(fn($c) => "`$c` = ?", $cols));
        $st = $conexion->prepare("UPDATE `$m` SET $set WHERE id = ?");
        $st->bind_param($tipos . 'i', ...array_merge($vals, [$id]));
    } else {
        $ph = implode(", ", array_fill(0, count($cols), '?'));
        $st = $conexion->prepare("INSERT INTO `$m` (`" . implode("`, `", $cols) . "`) VALUES ($ph)");
        $st->bind_param($tipos, ...$vals);
    }
    $st->execute();
    $_SESSION['msg'] = ['success', $id ? 'Registro actualizado.' : 'Registro guardado.'];
} catch (mysqli_sql_exception $e) {
    $txt = $e->getCode() == 1062 ? 'Ya existe un registro con ese valor único (por ejemplo, el usuario).' : 'No se pudo guardar: ' . $e->getMessage();
    $_SESSION['msg'] = ['danger', $txt];
}
header("Location: listado.php?m=$m");
