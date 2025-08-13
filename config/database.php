<?php 

class Database{
    private $host = "localhost";
    private $db_name = "youtube";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn  = null;
        try{
            $this->conn = new PDO("mysql:host". $this->host."; dbname=".$this->db_name,$this->username,$this->password);
            $this->conn->exec("set names utf8")

        }catch(\Thorwable $th){
            echo "Error en la conexion" .$th-> getMessage();


        }
        return $this->conn;

    }
}

?>
