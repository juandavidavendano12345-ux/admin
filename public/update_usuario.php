<?php
include_once '../config/Database.php';
include_once '../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_POST) {
    $usuario->id_usuarios = $_POST['id_usuarios'];
    $usuario->usuario = $_POST['usuario'];
    $usuario->documento = $_POST['documento'];
    $usuario->nombre = $_POST['nombre'];
    $usuario->apellido = $_POST['apellido'];
    $usuario->id_estado_usuario = $_POST['id_estado_usuario'];
    $usuario->id_roles = $_POST['id_roles'];
    $usuario->correo = $_POST['correo'];

    // Lógica para la contraseña: solo se actualiza si el campo no está vacío
    if (!empty($_POST['contraseña'])) {
        $usuario->contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    } else {
        // Si la contraseña está vacía, se debe obtener la actual del usuario
        // Esto requiere una consulta adicional para obtener el hash existente
        $stmt_current = $db->prepare("SELECT contraseña FROM usuarios WHERE id_usuarios = ?");
        $stmt_current->bindParam(1, $usuario->id_usuarios);
        $stmt_current->execute();
        $row_current = $stmt_current->fetch(PDO::FETCH_ASSOC);
        $usuario->contraseña = $row_current['contraseña'];
    }

    if ($usuario->update()) {
        echo "<div>Usuario actualizado exitosamente.</div>";
    } else {
        echo "<div>No se pudo actualizar el usuario.</div>";
    }
} else {
    // Si la solicitud es GET, precarga el formulario con los datos
    if (isset($_GET['id_usuarios']) && $usuario->readOne()) {
        $usuario->id_usuarios = $_GET['id_usuarios'];
        $usuario->readOne();
    } else {
        echo "<div>Error: No se proporcionó un ID de usuario.</div>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Usuario</title>
</head>
<body>
    <h1>Actualizar Usuario</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id_usuarios" value="<?php echo htmlspecialchars($usuario->id_usuarios); ?>">
        <label for="usuario">Usuario</label><input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario->usuario); ?>" required><br>
        <label for="contraseña">Contraseña (dejar en blanco para no cambiar)</label><input type="password" id="contraseña" name="contraseña"><br>
        <label for="documento">Documento</label><input type="text" id="documento" name="documento" value="<?php echo htmlspecialchars($usuario->documento); ?>" required><br>
        <label for="nombre">Nombre</label><input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->nombre); ?>" required><br>
        <label for="apellido">Apellido</label><input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario->apellido); ?>" required><br>
        <label for="id_estado_usuario">Estado (ID)</label><input type="number" id="id_estado_usuario" name="id_estado_usuario" value="<?php echo htmlspecialchars($usuario->id_estado_usuario); ?>" required><br>
        <label for="id_roles">Rol (ID)</label><input type="number" id="id_roles" name="id_roles" value="<?php echo htmlspecialchars($usuario->id_roles); ?>" required><br>
        <label for="correo">Correo</label><input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario->correo); ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="index_usuarios.php">Volver</a>
</body>
</html>