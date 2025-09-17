<?php
class DetalleVenta {
    private $conn;
    private $table_name = "detalle_venta";

    public $id_detalle_venta;
    public $cantidad_por_producto;
    public $total_parcial;
    public $id_compra;
    public $id_producto;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET cantidad_por_producto=:cantidad_por_producto, total_parcial=:total_parcial, id_compra=:id_compra, id_producto=:id_producto";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->cantidad_por_producto = htmlspecialchars(strip_tags($this->cantidad_por_producto));
        $this->total_parcial = htmlspecialchars(strip_tags($this->total_parcial));
        $this->id_compra = htmlspecialchars(strip_tags($this->id_compra));
        $this->id_producto = htmlspecialchars(strip_tags($this->id_producto));

        // Vincular parámetros
        $stmt->bindParam(":cantidad_por_producto", $this->cantidad_por_producto);
        $stmt->bindParam(":total_parcial", $this->total_parcial);
        $stmt->bindParam(":id_compra", $this->id_compra);
        $stmt->bindParam(":id_producto", $this->id_producto);

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
        $query = "UPDATE " . $this->table_name . " SET cantidad_por_producto = :cantidad_por_producto, total_parcial = :total_parcial, id_compra = :id_compra, id_producto = :id_producto WHERE id_detalle_venta = :id_detalle_venta";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->cantidad_por_producto = htmlspecialchars(strip_tags($this->cantidad_por_producto));
        $this->total_parcial = htmlspecialchars(strip_tags($this->total_parcial));
        $this->id_compra = htmlspecialchars(strip_tags($this->id_compra));
        $this->id_producto = htmlspecialchars(strip_tags($this->id_producto));
        $this->id_detalle_venta = htmlspecialchars(strip_tags($this->id_detalle_venta));

        // Vincular parámetros
        $stmt->bindParam(":cantidad_por_producto", $this->cantidad_por_producto);
        $stmt->bindParam(":total_parcial", $this->total_parcial);
        $stmt->bindParam(":id_compra", $this->id_compra);
        $stmt->bindParam(":id_producto", $this->id_producto);
        $stmt->bindParam(":id_detalle_venta", $this->id_detalle_venta);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_detalle_venta = :id_detalle_venta";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->id_detalle_venta = htmlspecialchars(strip_tags($this->id_detalle_venta));

        // Vincular parámetro
        $stmt->bindParam(":id_detalle_venta", $this->id_detalle_venta);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>