<?php
include_once '../config/Database.php';
include_once '../classes/Producto.php';
$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);
if ($_POST) {
    $producto->nombre = $_POST['nombre'];
    $producto->precio_venta = $_POST['precio_venta'];
    $producto->cantidad_producto = $_POST['cantidad_producto'];
    $producto->descripcion = $_POST['descripcion'];
    $producto->unidad_de_medida = $_POST['unidad_de_medida'];
    if ($producto->create()) {
        echo "<div>Producto creado exitosamente.</div>";
    } else {
        echo "<div>No se pudo crear el producto.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Nuevo Producto</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Nombre</label><input type="text" id="nombre" name="nombre"><br>
        <label for="precio_venta">Precio Venta</label><input type="number" step="0.01" id="precio_venta" name="precio_venta"><br>
        <label for="cantidad_producto">Cantidad</label><input type="number" id="cantidad_producto" name="cantidad_producto"><br>
        <label for="descripcion">Descripción</label><input type="text" id="descripcion" name="descripcion"><br>
        <label for="unidad_de_medida">Unidad de Medida</label><input type="text" id="unidad_de_medida" name="unidad_de_medida"><br>
        <button type="submit">Crear</button>
    </form>
    <a href="index_productos.php">Volver</a>
</body>
</html>