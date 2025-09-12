<?php
class User {
private $conn;
private $table_name = "compras";
public $id_compra;
public $datos;
public $total;
public $id_usuarios;
public function __construct($db) {
$this->conn = $db;
}
public function create() {
$query = "INSERT INTO " . $this->table_name . " SET datos=:datos, total=:total, id_usuarios=:id_usuarios";
$stmt = $this->conn->prepare($query);
$stmt->bindParam(":datos", $this->datos);
$stmt->bindParam(":total", $this->total);
$stmt->bindParam(":id_usuarios", $this->id_usuarios);
if ($stmt->execute()) {
return true;
}
return false;
}
public function read() {
$query = "SELECT * FROM " . $this->table_name;
$stmt = $this->conn->prepare($query);
$stmt->execute();
return $stmt;
}
public function update() {
       
    $query = "UPDATE " . $this->table_name . " SET datos=:datos, total=:total, id_usuarios=:id_usuarios WHERE id_compra = :id_compra";
    $stmt = $this->conn->prepare($query); 

        
    $stmt->bindParam(":datos", $this->datos);
    $stmt->bindParam(":total", $this->total);
    $stmt->bindParam(":id_usuarios", $this->id_usuarios);
    $stmt->bindParam(":id_compra", $this->id_compra);

     if ($stmt->execute()) {
        return true;
    }
    return false;
}
public function delete() {
$query = "DELETE FROM " . $this->table_name . " WHERE id_compra = :id_compra";
$stmt = $this->conn->prepare($query);
$stmt->bindParam(":id_compra", $this->id_compra);
if ($stmt->execute()) {
return true;
}
return false;
}
}
?>