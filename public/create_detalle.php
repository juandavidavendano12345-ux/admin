<?php
include_once '../config/Database.php';
include_once '../classes/DetalleVenta.php';

$database = new Database();
$db = $database->getConnection();
$detalle_venta = new DetalleVenta($db);

if ($_POST) {
    $detalle_venta->cantidad_por_producto = $_POST['cantidad_por_producto'];
    $detalle_venta->total_parcial = $_POST['total_parcial'];
    $detalle_venta->id_compra = $_POST['id_compra'];
    $detalle_venta->id_producto = $_POST['id_producto'];

    if ($detalle_venta->create()) {
        echo "<div>El detalle de venta fue creado exitosamente.</div>";
    } else {
        echo "<div>No se pudo crear el detalle de venta.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Detalle de Venta</title>
</head>
<body>
    <h1>Crear Nuevo Detalle de Venta</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="cantidad_por_producto">Cantidad por Producto</label>
        <input type="number" id="cantidad_por_producto" name="cantidad_por_producto">
        <br>
        <label for="total_parcial">Total Parcial</label>
        <input type="number" step="0.01" id="total_parcial" name="total_parcial">
        <br>
        <label for="id_compra">ID Compra</label>
        <input type="number" id="id_compra" name="id_compra">
        <br>
        <label for="id_producto">ID Producto</label>
        <input type="number" id="id_producto" name="id_producto">
        <br>
        <button type="submit">Crear</button>
    </form>
    <a href="index_detalle.php">Volver a la lista</a>
</body>
</html>