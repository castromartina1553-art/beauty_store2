<?php include("session.php")?>
<?php include("conexion.php")?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Editar Usuario | Beauty Store</title>
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
                <h5 class="m-b-10">Usuarios</h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="listado_usuarios.php">Usuarios</a></li>
                <li class="breadcrumb-item" aria-current="page">Editar</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

<?php       
if(isset($_GET['id'])){
    $codigo = $_GET['id'];
    $query = "SELECT * FROM usuarios WHERE id = $codigo";
    $result = mysqli_query($conexion, $query);
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $email = $row['email'];
        $telefono = $row['telefono'];    
        $usuario = $row['usuario'];
        $clave = $row['clave'];
        $tipo = $row['tipo_usuario_id'];
    }
}
if (isset($_POST['update2'])){
    $codigo = $_GET['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $tipos = $_POST['tipo'];

    $query = "UPDATE usuarios 
              SET nombre = '$nombre', 
                  email = '$email',
                  telefono = '$telefono',                        
                  usuario = '$usuario',
                  clave = '$clave',
                  tipo_usuario_id = $tipos
              WHERE id = $codigo";
    $result = mysqli_query($conexion, $query);
    if (!$result){
        echo "El query de actualizar falló";
    }else{
        ?>
        <script>alert("Registro actualizado");</script>
        <script>
        window.location = "listado_usuarios.php";
        </script>
        <?php 
    }
}
?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Editar Usuario</h5>
            </div>
            <div class="card-body">
              <div class="card my-5">
                <div class="card-body">
                  <form action="editar_usuarios.php?id=<?php echo $codigo?>" method="POST">
                    <div class="form-group mb-3">
                      <label class="form-label">Nombre*</label>
                      <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $nombre?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">E-mail*</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Teléfono</label>
                      <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?php echo $telefono?>">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Usuario*</label>
                      <input type="text" name="usuario" class="form-control" placeholder="Usuario" value="<?php echo $usuario?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Clave*</label>
                      <input type="password" name="clave" class="form-control" placeholder="Clave" value="<?php echo $clave?>" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label">Tipo Usuario*</label>
                      <select name="tipo" id="tipo" class="form-control" required>
                        <option value="">Seleccionar el tipo</option>
                        <?php
                        $query = "SELECT * FROM tipos_usuarios;";
                        $result_tipos = mysqli_query($conexion, $query);
                        while($row = mysqli_fetch_array($result_tipos)){
                            if ($tipo == $row['id']){ ?>
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