<?php include("session.php")?>
<?php include("conexion.php")?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Alta de Producto | Beauty Store</title>
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
              <span><?php echo $_SESSION['usuario']; ?></span>
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
                <h5 class="m-b-10">Productos</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="listado_productos.php">Productos</a></li>
                <li class="breadcrumb-item" aria-current="page">Alta</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Alta de Producto</h5>
            </div>
            <div class="card-body">
              <div class="card my-5">
                <div class="card-body">
                  <form action="grabar_productos.php" method="POST">
                    <div class="form-group mb-3">
                      <label class="form-label">Nombre*</label>
                      <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Descripción</label>
                      <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Precio*</label>
                      <input type="number" step="0.01" name="precio" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Stock*</label>
                      <input type="number" name="stock" class="form-control" placeholder="0" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Categoría*</label>
                      <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Seleccionar categoría</option>
                        <?php
                        $query = "SELECT * FROM categorias;";
                        $result_cat = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_cat)){ ?>
                          <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Marca*</label>
                      <select name="marca_id" id="marca_id" class="form-control" required>
                        <option value="">Seleccionar marca</option>
                        <?php
                        $query = "SELECT * FROM marcas;";
                        $result_marcas = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_marcas)){ ?>
                          <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Proveedor*</label>
                      <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                        <option value="">Seleccionar proveedor</option>
                        <?php
                        $query = "SELECT * FROM proveedores;";
                        $result_prov = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_prov)){ ?>
                          <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="d-grid mt-3">
                      <input type="submit" class="btn btn-success" name="guardar_registro" value="Guardar">
                    </div>
                  </form>
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