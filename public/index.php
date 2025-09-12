<?php
include_once '../config/Database.php';
include_once '../classes/User.php';
$database = new Database();
$db = $database->getConnection();


$user = new User($db);
$stmt = $user->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CRUD App</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>CRUD Application</h1>
<a href="create.php">Create New User</a>
<table>
<thead>
<tr>
<th>ID_COMPRA</th>
<th>DATOS</th>
<th>TOTAL</th>
<th>ID_USUARIOS</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
<td><?php echo $row['id_compra']; ?></td>
<td><?php echo $row['datos']; ?></td>
<td><?php echo $row['total']; ?></td>
<td><?php echo $row['id_usuarios']; ?></td>
<td>
<a href="update.php?id=<?php echo $row['id_compra']; ?>">Edit</a>
<a href="delete.php?id=<?php echo $row['id_compra']; ?>">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>


</body>
</html>