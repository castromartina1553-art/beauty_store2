<?php include("session.php")?>
<?php include("conexion.php")?>
<?php
if(!isset($_SESSION['tipo_usuario_id']) || $_SESSION['tipo_usuario_id'] != 1){
    echo '<script>alert("Acceso denegado: solo para Administradores."); window.location = "dashboard.php";</script>';
    exit();
}
?>

<?php
if(isset($_GET['id'])){
    $codigo = $_GET['id'];
    $query = "DELETE FROM usuarios WHERE id = $codigo";
    $result = mysqli_query($conexion, $query);
    if(!$result)
    {
        die("El query para eliminar falló");
    }
    else{
        ?>
        <script>alert("Registro Eliminado");</script>
        <?php 
    }
}
?>
<script>
window.location = "listado_usuarios.php";
</script>