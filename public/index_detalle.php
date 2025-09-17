<?php
include_once '../config/Database.php';
include_once '../classes/DetalleVenta.php';

$database = new Database();
$db = $database->getConnection();
$detalle_venta = new DetalleVenta($db);
$stmt = $detalle_venta->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles de Venta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Listado de Detalles de Venta</h1>
    <a href="create_detalle.php">Crear Nuevo Detalle</a>
    <table>
        <thead>
            <tr>
                <th>ID Detalle</th>
                <th>Cantidad</th>
                <th>Total Parcial</th>
                <th>ID Compra</th>
                <th>ID Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_detalle_venta']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad_por_producto']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_parcial']); ?></td>
                    <td><?php echo htmlspecialchars($row['id_compra']); ?></td>
                    <td><?php echo htmlspecialchars($row['id_producto']); ?></td>
                    <td>
                        <a href="update_detalle.php?id_detalle_venta=<?php echo htmlspecialchars($row['id_detalle_venta']); ?>">Editar</a>
                        <a href="delete_detalle.php?id_detalle_venta=<?php echo htmlspecialchars($row['id_detalle_venta']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>