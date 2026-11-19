<?php include("session.php")?>
<?php include("conexion.php")?>
<?php
if(!isset($_SESSION['tipo_usuario_id']) || $_SESSION['tipo_usuario_id'] != 1){
    echo '<script>alert("Acceso denegado: solo para Administradores."); window.location = "dashboard.php";</script>';
    exit();
}
?>
<?php 

if (isset($_POST['guardar_registro'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
}

$query = "INSERT INTO tipos_usuarios(nombre, descripcion) VALUES ('$nombre','$descripcion')";
$result = mysqli_query($conexion, $query);
if(!$result){
    die("Fallo en el query. Existe un problema en la base de datos.");
}
else{
    ?>
    <script>alert("Registro Guardado");</script>
    <?php 
}
?>
<script>
window.location = "listado_tipos_usuarios.php";
</script>