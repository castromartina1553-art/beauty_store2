<?php include("session.php")?>
<!DOCTYPE html>
<html lang="en">
<?php include("conexion.php")?>
<head>
  <title>Dashboard | Beauty Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/backend.css?v=4">
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <!-- [ Sidebar Menu ] start -->
  <nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="dashboard.php" class="b-brand text-primary">
          Beauty Store
        </a>
      </div>
      <div class="navbar-content">
        <?php include("inc/menu.php"); ?>
      </div>
    </div>
  </nav>
  <!-- [ Sidebar Menu ] end -->

  <!-- [ Header Topbar ] start -->
  <header class="pc-header">
    <div class="header-wrapper">
      <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
          <li class="pc-h-item pc-sidebar-collapse">
            <a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ti ti-menu-2"></i></a>
          </li>
          <li class="pc-h-item pc-sidebar-popup">
            <a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ti ti-menu-2"></i></a>
          </li>
        </ul>
      </div>
      <div class="ms-auto">
        <ul class="list-unstyled">
          <li class="dropdown pc-h-item header-user-profile">
            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button">
              <span>Admin</span>
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
              <a href="salir.php" class="dropdown-item"><i class="ti ti-power"></i><span>Logout</span></a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <!-- [ Header ] end -->

  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Panel Principal - Beauty Store</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Productos</h6>
            <p class="text-muted">Gestionar el catálogo de maquillaje.</p>
            <a href="listado_productos.php" class="btn btn-warning mt-auto">Ver productos</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Categorías</h6>
            <p class="text-muted">Organizar los productos por categoría.</p>
            <a href="listado_categorias.php" class="btn btn-warning mt-auto">Ver categorías</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Marcas</h6>
            <p class="text-muted">Administrar las marcas disponibles.</p>
            <a href="listado_marcas.php" class="btn btn-warning mt-auto">Ver marcas</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Proveedores</h6>
            <p class="text-muted">Consultar y administrar proveedores.</p>
            <a href="listado_proveedores.php" class="btn btn-warning mt-auto">Ver proveedores</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Clientes</h6>
            <p class="text-muted">Administrar la información de clientes.</p>
            <a href="listado_clientes.php" class="btn btn-warning mt-auto">Ver clientes</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Pedidos</h6>
            <p class="text-muted">Consultar los pedidos de la tienda.</p>
            <a href="listado_pedidos.php" class="btn btn-warning mt-auto">Ver pedidos</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Detalle de pedido</h6>
            <p class="text-muted">Consultar los productos y cantidades de cada pedido.</p>
            <a href="listado_detalle_pedido.php" class="btn btn-warning mt-auto">Ver detalles</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Usuarios</h6>
            <p class="text-muted">Administrar las cuentas del sistema.</p>
            <a href="listado_usuarios.php" class="btn btn-warning mt-auto">Ver usuarios</a>
          </div></div>
        </div>
        <div class="col-sm-6 col-xl-4">
          <div class="card h-100"><div class="card-body d-flex flex-column">
            <h6>Tipos de usuario</h6>
            <p class="text-muted">Administrar los tipos de acceso al sistema.</p>
            <a href="listado_tipos_usuarios.php" class="btn btn-warning mt-auto">Ver tipos de usuario</a>
          </div></div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

  <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm my-1">
          <p class="m-0">Beauty Store - Panel Administrativo</p>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>