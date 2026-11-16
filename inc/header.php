<?php include_once __DIR__ . "/../session.php"; include_once __DIR__ . "/modulos.php";
$es_admin = ($_SESSION['tipo'] ?? 0) === 1;
$grupos = [];
foreach ($MODULOS as $k => $mod) {
    if (!empty($mod['solo_admin']) && !$es_admin) continue;
    $grupos[$mod['grupo']][$k] = $mod;
}
$mod_activo = $_GET['m'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($titulo_pagina ?? 'Beauty Store') ?> | Beauty Store</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/backend.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid bg-primary mb-4">
  <div class="container-fluid px-lg-5">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
      <a href="dashboard.php" class="navbar-brand"><h2 class="text-white mb-0"><i class="fas fa-heart"></i> Beauty Store</h2></a>
      <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto">
          <a href="dashboard.php" class="nav-item nav-link <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">Inicio</a>
          <?php foreach ($grupos as $g => $items): ?>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle <?= isset($items[$mod_activo]) ? 'active' : '' ?>" data-bs-toggle="dropdown"><?= e($g) ?></a>
              <div class="dropdown-menu bg-light mt-2">
                <?php foreach ($items as $k => $mod): ?>
                  <a href="listado.php?m=<?= $k ?>" class="dropdown-item"><i class="<?= $mod['icono'] ?> me-2 text-primary"></i><?= e($mod['titulo']) ?></a>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <span class="text-white mx-3 d-none d-lg-inline"><i class="fas fa-user"></i> <?= e($_SESSION['nombre']) ?></span>
        <a href="salir.php" class="btn btn-dark py-2 px-4 d-none d-lg-inline-block"><i class="fas fa-sign-out-alt"></i> Salir</a>
        <a href="salir.php" class="nav-item nav-link d-lg-none text-white">Salir (<?= e($_SESSION['nombre']) ?>)</a>
      </div>
    </nav>
  </div>
</div>
<div class="container-fluid px-lg-5 pb-5">
