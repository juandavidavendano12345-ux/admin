<?php
include_once '../config/Database.php';
include_once '../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if (isset($_GET['id_usuarios'])) {
    $usuario->id_usuarios = $_GET['id_usuarios'];
    if ($usuario->delete()) {
        header("Location: index_usuarios.php?message=deleted");
    } else {
        header("Location: index_usuarios.php?message=error");
    }
} else {
    header("Location: index_usuarios.php?message=no_id");
}
exit();
?>