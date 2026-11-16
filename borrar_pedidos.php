<?php include("session.php")?>
<?php include("conexion.php")?>

<?php
if(isset($_GET['id'])){
    $codigo = $_GET['id'];
    mysqli_query($conexion, "DELETE FROM detalle_pedido WHERE pedido_id = $codigo");
    $query = "DELETE FROM pedidos WHERE id = $codigo";
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
window.location = "listado_pedidos.php";
</script>