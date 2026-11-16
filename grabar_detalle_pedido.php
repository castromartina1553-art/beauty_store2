<?php include("session.php")?>
<?php include("conexion.php")?>
<?php 

if (isset($_POST['guardar_registro'])){
    $pedido_id = $_POST['pedido_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
}

$query = "INSERT INTO detalle_pedido(pedido_id, producto_id, cantidad, precio_unitario) 
          VALUES ($pedido_id, $producto_id, $cantidad, '$precio_unitario')";
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
window.location = "listado_detalle_pedido.php";
</script>