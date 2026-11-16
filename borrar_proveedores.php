<?php include("session.php")?>
<?php include("conexion.php")?>

<?php
if(isset($_GET['id'])){
    $codigo = $_GET['id'];
    $query = "DELETE FROM proveedores WHERE id = $codigo";
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
window.location = "listado_proveedores.php";
</script>