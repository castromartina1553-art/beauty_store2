<?php
include "inc/header.php";
include "conexion.php";
[$m, $mod] = modulo_actual();
$titulo_pagina = $mod['titulo'];

// Armar SELECT con JOIN para mostrar el nombre de las claves foráneas
$select = ["t.id"]; $joins = []; $cols = []; $i = 0;
foreach ($mod['campos'] as $campo => $c) {
    if ($c['tipo'] === 'password') continue;
    $cols[$campo] = $c;
    if ($c['tipo'] === 'select') {
        $i++;
        $select[] = "j$i.`{$c['fk']['label']}` AS `$campo`";
        $joins[] = "LEFT JOIN `{$c['fk']['tabla']}` j$i ON j$i.id = t.`$campo`";
    } else {
        $select[] = "t.`$campo`";
    }
}
$sql = "SELECT " . implode(", ", $select) . " FROM `$m` t " . implode(" ", $joins) . " ORDER BY t.id DESC";
$res = $conexion->query($sql);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0"><i class="<?= $mod['icono'] ?>"></i> <?= e($mod['titulo']) ?></h3>
  <a href="form.php?m=<?= $m ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</a>
</div>

<?php if (!empty($_SESSION['msg'])): ?>
  <div class="alert alert-<?= e($_SESSION['msg'][0]) ?> alert-dismissible fade show"><?= e($_SESSION['msg'][1]) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php unset($_SESSION['msg']); endif; ?>

<div class="card"><div class="card-body table-responsive">
<table class="table table-hover align-middle">
  <thead><tr><th>#</th><?php foreach ($cols as $c): ?><th><?= e($c['label']) ?></th><?php endforeach; ?><th class="text-end">Acciones</th></tr></thead>
  <tbody>
  <?php if ($res->num_rows === 0): ?>
    <tr><td colspan="<?= count($cols) + 2 ?>" class="text-center text-muted">No hay registros.</td></tr>
  <?php endif; ?>
  <?php while ($r = $res->fetch_assoc()): ?>
    <tr>
      <td><?= $r['id'] ?></td>
      <?php foreach ($cols as $campo => $c): ?>
        <td><?= e($c['tipo'] === 'decimal' ? number_format((float)$r[$campo], 2, ',', '.') : $r[$campo]) ?></td>
      <?php endforeach; ?>
      <td class="text-end text-nowrap">
        <a href="form.php?m=<?= $m ?>&id=<?= $r['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
        <form action="borrar.php" method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este registro?');">
          <input type="hidden" name="m" value="<?= $m ?>">
          <input type="hidden" name="id" value="<?= $r['id'] ?>">
          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
          <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Borrar</button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
</div></div>
<?php include "inc/footer.php"; ?>
