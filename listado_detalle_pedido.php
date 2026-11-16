<?php include("session.php")?>
<!DOCTYPE html>
<html lang="en">
<?php include("conexion.php")?>
<head>
  <title>Listado de Detalle de Pedido | Beauty Store</title>
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
                <h5 class="m-b-10">Detalle de Pedido</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Listado de Detalles</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Listado de Detalle de Pedido</h5>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                <div class="card tbl-card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <a href="crear_detalle_pedido.php">
                        <button type="button" class="btn btn-warning" name="update">Nuevo</button>
                      </a>
                      <table class="table table-hover table-borderless mb-0">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>N° Pedido</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th class="text-end">Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query = "SELECT dp.id, dp.pedido_id, c.nombre AS cliente, pr.nombre AS producto, dp.cantidad, dp.precio_unitario
                                    FROM detalle_pedido dp, pedidos p, clientes c, productos pr
                                    WHERE dp.pedido_id = p.id 
                                      AND p.cliente_id = c.id
                                      AND dp.producto_id = pr.id";
                          $result_detalles = mysqli_query($conexion, $query);

                          while($row = mysqli_fetch_array($result_detalles)){ 
                            $subtotal = $row['cantidad'] * $row['precio_unitario'];
                          ?>
                          <tr>
                            <td><a href="#" class="text-muted"><?php echo $row['id']?></a></td>
                            <td>#<?php echo $row['pedido_id']?></td>
                            <td><?php echo $row['cliente']?></td>
                            <td><?php echo $row['producto']?></td>
                            <td><?php echo $row['cantidad']?></td>
                            <td>$<?php echo $row['precio_unitario']?></td>
                            <td>$<?php echo number_format($subtotal, 2)?></td>
                            <td class="text-end">
                              <a href="editar_detalle_pedido.php?id=<?php echo $row['id']?>">
                                <button type="button" class="btn btn-warning" name="update">Modificar</button>
                              </a>
                              <a href="borrar_detalle_pedido.php?id=<?php echo $row['id']?>">
                                <button type="button" class="btn btn-danger">Eliminar</button>
                              </a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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