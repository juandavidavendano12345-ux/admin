<?php
include_once '../config/Database.php';
include_once '../classes/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
if ($_POST) {
$user->id_compra = $_POST['id_compra'];
$user->datos = $_POST['datos'];
$user->total = $_POST['total'];
$user->id_usuarios = $_POST['id_usuarios'];
if ($user->update()) {
echo "<div>User was updated.</div>";
} else {
echo "<div>Unable to update user.</div>";
}
} else {
$stmt = $user->read();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user->datos = $row['datos'];
$user->total = $row['total'];
$user->id_usuarios = $row['id_usuarios'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update User</title>
</head>
<body>
<h1>Update User</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
method="post">
<input type="hidden" name="id_compra" value="<?php echo $user->id_compra; ?>">

<label for="name">datos</label>
<input type="text" id="datos" name="datos" value="<?php echo $user->datos;?>">
<br>
<label for="email">total</label>
<input type="number" id="total" name="total"value="<?php echo $user->total;?>">
<br>
<label for="age">id_usuario</label>
<input type="text" id="id_usuario" name="id_usuarios"value="<?php echo $user->id_usuarios;?>">
<br>
<button type="submit">Update</button>
</form>
<a href="index.php">Back to list</a>
</body>
</html>
