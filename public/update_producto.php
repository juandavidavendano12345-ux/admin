<?php
include_once '../config/Database.php';
include_once '../classes/Producto.php';
$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);
if ($_POST) {
    $producto->id_producto = $_POST['id_producto'];
    $producto->nombre = $_POST['nombre'];
    $producto->precio_venta = $_POST['precio_venta'];
    $producto->cantidad_producto = $_POST['cantidad_producto'];
    $producto->descripcion = $_POST['descripcion'];
    $producto->unidad_de_medida = $_POST['unidad_de_medida'];
    if ($producto->update()) {
        echo "<div>Producto actualizado exitosamente.</div>";
    } else {
        echo "<div>No se pudo actualizar el producto.</div>";
    }
} else {
    if (isset($_GET['id_producto'])) {
        $producto->id_producto = $_GET['id_producto'];
        $stmt = $producto->read();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['id_producto'] == $producto->id_producto) {
                $producto->nombre = $row['nombre'];
                $producto->precio_venta = $row['precio_venta'];
                $producto->cantidad_producto = $row['cantidad_producto'];
                $producto->descripcion = $row['descripcion'];
                $producto->unidad_de_medida = $row['unidad_de_medida'];
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto</title>
</head>
<body>
    <h1>Actualizar Producto</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto->id_producto); ?>">
        <label for="nombre">Nombre</label><input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto->nombre); ?>"><br>
        <label for="precio_venta">Precio Venta</label><input type="number" step="0.01" id="precio_venta" name="precio_venta" value="<?php echo htmlspecialchars($producto->precio_venta); ?>"><br>
        <label for="cantidad_producto">Cantidad</label><input type="number" id="cantidad_producto" name="cantidad_producto" value="<?php echo htmlspecialchars($producto->cantidad_producto); ?>"><br>
        <label for="descripcion">Descripción</label><input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($producto->descripcion); ?>"><br>
        <label for="unidad_de_medida">Unidad de Medida</label><input type="text" id="unidad_de_medida" name="unidad_de_medida" value="<?php echo htmlspecialchars($producto->unidad_de_medida); ?>"><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="index_productos.php">Volver</a>
</body>
</html>