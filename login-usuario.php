<?php
session_start();
include("conexion.php");

if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['tipo_usuario_id'] = $row['tipo_usuario_id'];
        header("Location: listado_categorias.php");
        exit();
    } else {
        ?>
        <script>
            alert("Usuario o contraseña incorrectos");
            window.location = "index.html";
        </script>
        <?php
    }
}
?>