<?php
include_once '../config/Database.php';
include_once '../classes/DetalleVenta.php';

$database = new Database();
$db = $database->getConnection();
$detalle_venta = new DetalleVenta($db);

if (isset($_GET['id_detalle_venta'])) {
    $detalle_venta->id_detalle_venta = $_GET['id_detalle_venta'];
    if ($detalle_venta->delete()) {
        header("Location: index_detalle.php?message=deleted");
    } else {
        header("Location: index_detalle.php?message=error");
    }
} else {
    header("Location: index_detalle.php?message=no_id");
}
?>