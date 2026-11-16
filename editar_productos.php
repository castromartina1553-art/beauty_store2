<?php include("session.php")?>
<?php include("conexion.php")?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Editar Producto | Beauty Store</title>
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
                <h5 class="m-b-10">Productos</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="listado_productos.php">Productos</a></li>
                <li class="breadcrumb-item" aria-current="page">Editar</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

<?php       
if(isset($_GET['id'])){
    $codigo = $_GET['id'];
    $query = "SELECT * FROM productos WHERE id = $codigo";
    $result = mysqli_query($conexion, $query);
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];    
        $stock = $row['stock'];
        $categoria_id = $row['categoria_id'];
        $marca_id = $row['marca_id'];
        $proveedor_id = $row['proveedor_id'];
    }
}
if (isset($_POST['update2'])){
    $codigo = $_GET['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria_id = $_POST['categoria_id'];
    $marca_id = $_POST['marca_id'];
    $proveedor_id = $_POST['proveedor_id'];

    $query = "UPDATE productos 
              SET nombre = '$nombre', 
                  descripcion = '$descripcion',
                  precio = '$precio',                        
                  stock = '$stock',
                  categoria_id = $categoria_id,
                  marca_id = $marca_id,
                  proveedor_id = $proveedor_id
              WHERE id = $codigo";
    $result = mysqli_query($conexion, $query);
    if (!$result){
        echo "El query de actualizar falló";
    }else{
        ?>
        <script>alert("Registro actualizado");</script>
        <script>
        window.location = "listado_productos.php";
        </script>
        <?php 
    }
}
?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Producto</h5>
            </div>
            <div class="card-body">
              <div class="card my-5">
                <div class="card-body">
                  <form action="editar_productos.php?id=<?php echo $codigo?>" method="POST">
                    <div class="form-group mb-3">
                      <label class="form-label">Nombre*</label>
                      <input type="text" name="nombre" class="form-control" value="<?php echo $nombre?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Descripción</label>
                      <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion?>">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Precio*</label>
                      <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $precio?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Stock*</label>
                      <input type="number" name="stock" class="form-control" value="<?php echo $stock?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Categoría*</label>
                      <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Seleccionar categoría</option>
                        <?php
                        $query = "SELECT * FROM categorias;";
                        $result_cat = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_cat)){
                            if ($categoria_id == $row['id']){ ?>
                              <option value="<?php echo $row['id']?>" selected="selected"><?php echo $row['nombre']?></option>
                            <?php } else { ?>
                              <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                            <?php }
                        } ?>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Marca*</label>
                      <select name="marca_id" id="marca_id" class="form-control" required>
                        <option value="">Seleccionar marca</option>
                        <?php
                        $query = "SELECT * FROM marcas;";
                        $result_marcas = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_marcas)){
                            if ($marca_id == $row['id']){ ?>
                              <option value="<?php echo $row['id']?>" selected="selected"><?php echo $row['nombre']?></option>
                            <?php } else { ?>
                              <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                            <?php }
                        } ?>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Proveedor*</label>
                      <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                        <option value="">Seleccionar proveedor</option>
                        <?php
                        $query = "SELECT * FROM proveedores;";
                        $result_prov = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_prov)){
                            if ($proveedor_id == $row['id']){ ?>
                              <option value="<?php echo $row['id']?>" selected="selected"><?php echo $row['nombre']?></option>
                            <?php } else { ?>
                              <option value="<?php echo $row['id']?>"><?php echo $row['nombre']?></option>
                            <?php }
                        } ?>
                      </select>
                    </div>
                    <div class="d-grid mt-3">
                      <input type="submit" class="btn btn-success" name="update2" value="Guardar">
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