<?php
include_once '../config/Database.php';
include_once '../classes/DetalleVenta.php';

$database = new Database();
$db = $database->getConnection();
$detalle_venta = new DetalleVenta($db);

if ($_POST) {
    $detalle_venta->id_detalle_venta = $_POST['id_detalle_venta'];
    $detalle_venta->cantidad_por_producto = $_POST['cantidad_por_producto'];
    $detalle_venta->total_parcial = $_POST['total_parcial'];
    $detalle_venta->id_compra = $_POST['id_compra'];
    $detalle_venta->id_producto = $_POST['id_producto'];

    if ($detalle_venta->update()) {
        echo "<div>El detalle de venta fue actualizado.</div>";
    } else {
        echo "<div>No se pudo actualizar el detalle de venta.</div>";
    }
} else {
    // Verificar si el ID está presente
    if (isset($_GET['id_detalle_venta'])) {
        $detalle_venta->id_detalle_venta = $_GET['id_detalle_venta'];
        $stmt = $detalle_venta->read();
        $found = false;

        // Buscar el registro específico para precargar el formulario
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['id_detalle_venta'] == $detalle_venta->id_detalle_venta) {
                $detalle_venta->cantidad_por_producto = $row['cantidad_por_producto'];
                $detalle_venta->total_parcial = $row['total_parcial'];
                $detalle_venta->id_compra = $row['id_compra'];
                $detalle_venta->id_producto = $row['id_producto'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "<div>Error: Detalle de venta no encontrado.</div>";
            exit;
        }
    } else {
        echo "<div>Error: No se proporcionó un ID de detalle de venta.</div>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Detalle de Venta</title>
</head>
<body>
    <h1>Actualizar Detalle de Venta</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id_detalle_venta" value="<?php echo htmlspecialchars($detalle_venta->id_detalle_venta); ?>">
        
        <label for="cantidad_por_producto">Cantidad por Producto</label>
        <input type="number" id="cantidad_por_producto" name="cantidad_por_producto" value="<?php echo htmlspecialchars($detalle_venta->cantidad_por_producto); ?>">
        <br>
        <label for="total_parcial">Total Parcial</label>
        <input type="number" step="0.01" id="total_parcial" name="total_parcial" value="<?php echo htmlspecialchars($detalle_venta->total_parcial); ?>">
        <br>
        <label for="id_compra">ID Compra</label>
        <input type="number" id="id_compra" name="id_compra" value="<?php echo htmlspecialchars($detalle_venta->id_compra); ?>">
        <br>
        <label for="id_producto">ID Producto</label>
        <input type="number" id="id_producto" name="id_producto" value="<?php echo htmlspecialchars($detalle_venta->id_producto); ?>">
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="index_detalle.php">Volver a la lista</a>
</body>
</html>