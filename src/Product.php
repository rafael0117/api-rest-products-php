<?php
class Product{
    private $conn;
    private $table_name = "productos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $creado_en;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table_name . 
                " SET nombre = :nombre, descripcion = :descripcion, precio = :precio, creado_en = NOW()";

        $stmt = $this->conn->prepare($query);
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->precio=htmlspecialchars(strip_tags($this->precio));

        $stmt -> bindParam(":nombre",$this->nombre);
        $stmt -> bindParam(":descripcion",$this->descripcion);
        $stmt -> bindParam(":precio",$this->precio);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function read(){
        $query = "SELECT id,nombre,descripcion,precio FROM ". $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update(){
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre,descripcion = :descripcion,precio =:precio WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt -> bindParam(":nombre",$this->nombre);
        $stmt -> bindParam(":descripcion",$this->descripcion);
        $stmt -> bindParam(":precio",$this->precio);
        $stmt -> bindParam(":id",$this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id =:id";
        $stmt = $this->conn->prepare($query);
        $this->id =htmlspecialchars(strip_tags($this->id));
        $stmt -> bindParam(":id",$this->id);
        if($stmt->execute()){
             return $stmt->rowCount() > 0;
        }
        return false;
    }

}


?>