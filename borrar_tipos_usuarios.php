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

    // Verificamos si hay usuarios asociados a este tipo de usuario
    $check = mysqli_query($conexion, "SELECT id FROM usuarios WHERE tipo_usuario_id = $codigo");

    if(mysqli_num_rows($check) > 0){
        ?>
        <script>alert("No se puede eliminar el tipo de usuario porque tiene usuarios asociados. Reasigna o elimina esos usuarios primero.");</script>
        <?php
    } else {
        // Verificamos si no tiene usuarios asociados, eliminamos normalmente
        $query = "DELETE FROM tipos_usuarios WHERE id = $codigo";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die("El query para eliminar falló");
        } else {
            ?>
            <script>alert("Registro Eliminado");</script>
            <?php
        }
    }
}
?>
<script>
window.location = "listado_tipos_usuarios.php";
</script>