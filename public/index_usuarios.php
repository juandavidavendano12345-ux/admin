<?php
include_once '../config/Database.php';
include_once '../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);
$stmt = $usuario->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Listado de Usuarios</h1>
    <a href="create_usuario.php">Crear Nuevo Usuario</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_usuarios']); ?></td>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td>
                        <a href="update_usuario.php?id_usuarios=<?php echo htmlspecialchars($row['id_usuarios']); ?>">Editar</a>
                        <a href="delete_usuario.php?id_usuarios=<?php echo htmlspecialchars($row['id_usuarios']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>