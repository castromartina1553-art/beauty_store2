<?php include("session.php")?>
<?php include("conexion.php")?>
<?php 

if (isset($_POST['guardar_registro'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria_id = $_POST['categoria_id'];
    $marca_id = $_POST['marca_id'];
    $proveedor_id = $_POST['proveedor_id'];
}

$query = "INSERT INTO productos(nombre, descripcion, precio, stock, categoria_id, marca_id, proveedor_id) 
          VALUES ('$nombre', '$descripcion', '$precio', '$stock', $categoria_id, $marca_id, $proveedor_id)";
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
window.location = "listado_productos.php";
</script>