<?php
include_once '../config/Database.php';
include_once '../classes/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->id_compra = $_GET['id_compra'];
if ($user->delete()) {
echo "<div>User was deleted.</div>";
} else {
echo "<div>Unable to delete user.</div>";
}
header("Location: index.php");
?>