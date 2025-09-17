<?php
include_once '../config/Database.php';
include_once '../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_POST) {
    // Aquí es donde se usa password_hash() para seguridad
    $usuario->usuario = $_POST['usuario'];
    $usuario->contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $usuario->documento = $_POST['documento'];
    $usuario->nombre = $_POST['nombre'];
    $usuario->apellido = $_POST['apellido'];
    $usuario->id_estado_usuario = $_POST['id_estado_usuario'];
    $usuario->id_roles = $_POST['id_roles'];
    $usuario->correo = $_POST['correo'];

    if ($usuario->create()) {
        echo "<div>Usuario creado exitosamente.</div>";
    } else {
        echo "<div>No se pudo crear el usuario.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Nuevo Usuario</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="usuario">Usuario</label><input type="text" id="usuario" name="usuario" required><br>
        <label for="contraseña">Contraseña</label><input type="password" id="contraseña" name="contraseña" required><br>
        <label for="documento">Documento</label><input type="text" id="documento" name="documento" required><br>
        <label for="nombre">Nombre</label><input type="text" id="nombre" name="nombre" required><br>
        <label for="apellido">Apellido</label><input type="text" id="apellido" name="apellido" required><br>
        <label for="id_estado_usuario">Estado (ID)</label><input type="number" id="id_estado_usuario" name="id_estado_usuario" required><br>
        <label for="id_roles">Rol (ID)</label><input type="number" id="id_roles" name="id_roles" required><br>
        <label for="correo">Correo</label><input type="email" id="correo" name="correo" required><br>
        <button type="submit">Crear</button>
    </form>
    <a href="index_usuarios.php">Volver</a>
</body>
</html>