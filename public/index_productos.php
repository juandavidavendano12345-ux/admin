<?php
include_once '../config/Database.php';
include_once '../classes/Producto.php';
$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);
$stmt = $producto->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Listado de Productos</h1>
    <a href="create_producto.php">Crear Nuevo Producto</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Unidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_producto']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['precio_venta']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad_producto']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($row['unidad_de_medida']); ?></td>
                    <td>
                        <a href="update_producto.php?id_producto=<?php echo htmlspecialchars($row['id_producto']); ?>">Editar</a>
                        <a href="delete_producto.php?id_producto=<?php echo htmlspecialchars($row['id_producto']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>