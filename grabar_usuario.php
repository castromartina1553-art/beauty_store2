<?php include("session.php")?>
<?php include("conexion.php")?>
<?php 

if (isset($_POST['guardar_registro'])){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $tipo = $_POST['tipo'];
}

$query = "INSERT INTO usuarios(nombre, email, telefono, usuario, clave, tipo_usuario_id) 
          VALUES ('$nombre','$email','$telefono','$usuario','$clave',$tipo)";
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
window.location = "listado_usuarios.php";
</script>