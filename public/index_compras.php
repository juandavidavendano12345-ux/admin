<?php
include_once '../config/Database.php';
include_once '../classes/Compra.php';

$database = new Database();
$db = $database->getConnection();
$compra = new Compra($db);
$stmt = $compra->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Listado de Compras</h1>
    <a href="create_compra.php">Crear Nueva Compra</a>
    <table>
        <thead>
            <tr>
                <th>ID Compra</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>ID Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_compra']); ?></td>
                    <td><?php echo htmlspecialchars($row['datos']); ?></td>
                    <td><?php echo htmlspecialchars($row['total']); ?></td>
                    <td><?php echo htmlspecialchars($row['id_usuarios']); ?></td>
                    <td>
                        <a href="update_compra.php?id_compra=<?php echo htmlspecialchars($row['id_compra']); ?>">Editar</a>
                        <a href="delete_compra.php?id_compra=<?php echo htmlspecialchars($row['id_compra']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>