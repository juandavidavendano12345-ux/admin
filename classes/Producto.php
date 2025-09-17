<?php
class Producto {
    private $conn;
    private $table_name = "productos";

    // Propiedades de la tabla 'productos'
    public $id_producto;
    public $nombre;
    public $precio_venta;
    public $cantidad_producto;
    public $descripcion;
    public $unidad_de_medida;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, precio_venta=:precio_venta, cantidad_producto=:cantidad_producto, descripcion=:descripcion, unidad_de_medida=:unidad_de_medida";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":cantidad_producto", $this->cantidad_producto);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":unidad_de_medida", $this->unidad_de_medida);

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
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, precio_venta = :precio_venta, cantidad_producto = :cantidad_producto, descripcion = :descripcion, unidad_de_medida = :unidad_de_medida WHERE id_producto = :id_producto";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":cantidad_producto", $this->cantidad_producto);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":unidad_de_medida", $this->unidad_de_medida);
        $stmt->bindParam(":id_producto", $this->id_producto);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_producto = :id_producto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_producto", $this->id_producto);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>