<?php include("session.php")?>
<?php include("conexion.php")?>
<?php 

if (isset($_POST['guardar_registro'])){
    $cliente_id = $_POST['cliente_id'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $total = $_POST['total'];
}

$query = "INSERT INTO pedidos(cliente_id, fecha, estado, total) 
          VALUES ($cliente_id, '$fecha', '$estado', '$total')";
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
window.location = "listado_pedidos.php";
</script>