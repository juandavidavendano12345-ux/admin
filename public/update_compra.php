<?php
include_once '../config/Database.php';
include_once '../classes/Compra.php';

$database = new Database();
$db = $database->getConnection();
$compra = new Compra($db);

if ($_POST) {
    $compra->id_compra = $_POST['id_compra'];
    $compra->datos = $_POST['datos'];
    $compra->total = $_POST['total'];
    $compra->id_usuarios = $_POST['id_usuarios'];

    if ($compra->update()) {
        echo "<div>La compra fue actualizada.</div>";
    } else {
        echo "<div>No se pudo actualizar la compra.</div>";
    }
} else {
    // Verificar si el ID está presente para evitar errores
    if (isset($_GET['id_compra'])) {
        $compra->id_compra = $_GET['id_compra'];
        $stmt = $compra->read();
        $found = false;

        // Buscar el registro específico para precargar el formulario
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['id_compra'] == $compra->id_compra) {
                $compra->datos = $row['datos'];
                $compra->total = $row['total'];
                $compra->id_usuarios = $row['id_usuarios'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "<div>Error: Compra no encontrada.</div>";
            exit;
        }
    } else {
        echo "<div>Error: No se proporcionó un ID de compra.</div>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Compra</title>
</head>
<body>
    <h1>Actualizar Compra</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="id_compra" value="<?php echo htmlspecialchars($compra->id_compra); ?>">
        
        <label for="datos">Fecha</label>
        <input type="date" id="datos" name="datos" value="<?php echo htmlspecialchars($compra->datos); ?>">
        <br>
        <label for="total">Total</label>
        <input type="number" step="0.01" id="total" name="total" value="<?php echo htmlspecialchars($compra->total); ?>">
        <br>
        <label for="id_usuarios">ID de Usuario</label>
        <input type="number" id="id_usuarios" name="id_usuarios" value="<?php echo htmlspecialchars($compra->id_usuarios); ?>">
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="index_compras.php">Volver a la lista</a>
</body>
</html>