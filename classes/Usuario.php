<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    // Propiedades de la tabla
    public $id_usuarios;
    public $usuario;
    public $contraseña;
    public $documento;
    public $nombre;
    public $apellido;
    public $id_estado_usuario;
    public $id_roles;
    public $correo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        // Consulta SQL para insertar un nuevo registro
        $query = "INSERT INTO " . $this->table_name . " SET
            usuario=:usuario, 
            contraseña=:contraseña, 
            documento=:documento, 
            nombre=:nombre, 
            apellido=:apellido, 
            id_estado_usuario=:id_estado_usuario, 
            id_roles=:id_roles, 
            correo=:correo";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para seguridad
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->contraseña = htmlspecialchars(strip_tags($this->contraseña));
        $this->documento = htmlspecialchars(strip_tags($this->documento));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->id_estado_usuario = htmlspecialchars(strip_tags($this->id_estado_usuario));
        $this->id_roles = htmlspecialchars(strip_tags($this->id_roles));
        $this->correo = htmlspecialchars(strip_tags($this->correo));

        // Vincular los valores a la consulta
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":contraseña", $this->contraseña);
        $stmt->bindParam(":documento", $this->documento);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":id_estado_usuario", $this->id_estado_usuario);
        $stmt->bindParam(":id_roles", $this->id_roles);
        $stmt->bindParam(":correo", $this->correo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        // Consulta SQL para obtener todos los registros
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        // Consulta SQL para obtener un solo registro por ID
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuarios = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_usuarios);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->usuario = $row['usuario'];
            $this->documento = $row['documento'];
            $this->nombre = $row['nombre'];
            $this->apellido = $row['apellido'];
            $this->id_estado_usuario = $row['id_estado_usuario'];
            $this->id_roles = $row['id_roles'];
            $this->correo = $row['correo'];
            // Nota: La contraseña no se carga por seguridad
            return true;
        }
        return false;
    }

    public function update() {
        // Consulta SQL para actualizar un registro
        $query = "UPDATE " . $this->table_name . " SET 
            usuario = :usuario, 
            contraseña = :contraseña, 
            documento = :documento, 
            nombre = :nombre, 
            apellido = :apellido, 
            id_estado_usuario = :id_estado_usuario, 
            id_roles = :id_roles, 
            correo = :correo 
            WHERE id_usuarios = :id_usuarios";
        
        $stmt = $this->conn->prepare($query);

        // Limpiar y vincular los valores
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->contraseña = htmlspecialchars(strip_tags($this->contraseña));
        $this->documento = htmlspecialchars(strip_tags($this->documento));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->id_estado_usuario = htmlspecialchars(strip_tags($this->id_estado_usuario));
        $this->id_roles = htmlspecialchars(strip_tags($this->id_roles));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->id_usuarios = htmlspecialchars(strip_tags($this->id_usuarios));

        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":contraseña", $this->contraseña);
        $stmt->bindParam(":documento", $this->documento);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":id_estado_usuario", $this->id_estado_usuario);
        $stmt->bindParam(":id_roles", $this->id_roles);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":id_usuarios", $this->id_usuarios);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        // Consulta SQL para eliminar un registro
        $query = "DELETE FROM " . $this->table_name . " WHERE id_usuarios = :id_usuarios";
        $stmt = $this->conn->prepare($query);
        
        $this->id_usuarios = htmlspecialchars(strip_tags($this->id_usuarios));
        $stmt->bindParam(":id_usuarios", $this->id_usuarios);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>