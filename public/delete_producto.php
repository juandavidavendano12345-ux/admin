<?php
include_once '../config/Database.php';
include_once '../classes/Producto.php';
$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);
if (isset($_GET['id_producto'])) {
    $producto->id_producto = $_GET['id_producto'];
    if ($producto->delete()) {
        header("Location: index_productos.php?message=deleted");
    } else {
        header("Location: index_productos.php?message=error");
    }
} else {
    header("Location: index_productos.php?message=no_id");
}
exit();
?>