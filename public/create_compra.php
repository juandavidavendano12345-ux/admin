<?php
include_once '../config/Database.php';
include_once '../classes/Compra.php';

$database = new Database();
$db = $database->getConnection();
$compra = new Compra($db);

if ($_POST) {
    $compra->datos = $_POST['datos'];
    $compra->total = $_POST['total'];
    $compra->id_usuarios = $_POST['id_usuarios'];

    if ($compra->create()) {
        echo "<div>La compra fue creada exitosamente.</div>";
    } else {
        echo "<div>No se pudo crear la compra.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Compra</title>
</head>
<body>
    <h1>Crear Nueva Compra</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="datos">Fecha (YYYY-MM-DD)</label>
        <input type="date" id="datos" name="datos">
        <br>
        <label for="total">Total</label>
        <input type="number" step="0.01" id="total" name="total">
        <br>
        <label for="id_usuarios">ID de Usuario</label>
        <input type="number" id="id_usuarios" name="id_usuarios">
        <br>
        <button type="submit">Crear</button>
    </form>
    <a href="index_compras.php">Volver a la lista</a>
</body>
</html>