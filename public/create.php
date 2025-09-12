<?php
include_once '../config/Database.php';
include_once '../classes/User.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
if ($_POST) {
$user->datos = $_POST['datos'];
$user->total = $_POST['total']; // ✅ corregido
$user->id_usuario = $_POST['id_usuarios'];
if ($user->create()) {
echo "<div>User was created.</div>";
} else {
echo "<div>Unable to create user.</div>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create User</title>
</head>
<body>
<h1>Create User</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
method="post">
<label for="name">datos</label>
<input type="text" id="datos" name="datos">
<br>
<label for="email">total</label>
<input type="number" id="total" name="total">
<br>
<label for="age">id_usuarios</label>
<input type="text" id="id_usuarios" name="id_usuarios">
<br>
<button type="submit">Create</button>
</form>
<a href="index.php">Back to list</a>
</body>
</html>