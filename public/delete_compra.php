<?php
include_once '../config/Database.php';
include_once '../classes/Compra.php';

$database = new Database();
$db = $database->getConnection();
$compra = new Compra($db);

if (isset($_GET['id_compra'])) {
    $compra->id_compra = $_GET['id_compra'];
    if ($compra->delete()) {
        header("Location: index_compras.php?message=deleted");
    } else {
        header("Location: index_compras.php?message=error");
    }
} else {
    header("Location: index_compras.php?message=no_id");
}
?>