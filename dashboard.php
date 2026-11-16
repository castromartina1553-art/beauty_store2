<?php
$titulo_pagina = 'Inicio';
include "inc/header.php";
include "conexion.php";
?>
<h3 class="mb-4">Panel de control</h3>
<div class="row g-4">
<?php foreach ($MODULOS as $k => $mod):
  if (!empty($mod['solo_admin']) && !$es_admin) continue;
  $n = $conexion->query("SELECT COUNT(*) c FROM `$k`")->fetch_assoc()['c']; ?>
  <div class="col-sm-6 col-lg-4 col-xl-3">
    <a href="listado.php?m=<?= $k ?>" class="text-decoration-none">
      <div class="card dash-card h-100"><div class="card-body d-flex align-items-center">
        <i class="<?= $mod['icono'] ?> fa-2x text-primary me-3"></i>
        <div><h6 class="mb-0 text-dark"><?= e($mod['titulo']) ?></h6><span class="text-secondary"><?= $n ?> registros</span></div>
      </div></div>
    </a>
  </div>
<?php endforeach; ?>
</div>
<?php include "inc/footer.php"; ?>
