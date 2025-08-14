<?php

require_once "../config/database.php";
require_once "Product.php";

class ProductoController {
    private $db;
    private $product;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db); // Corregido
    }

    public function create(){
        $data = json_decode(file_get_contents("php://input"));

        if(!$data){
            http_response_code(400);
            echo json_encode(["message" => "Formato JSON inválido"]);
            return;
        }

        if(!empty($data->nombre) && !empty($data->descripcion) && !empty($data->precio)){
            $this->product->nombre = $data->nombre;
            $this->product->descripcion = $data->descripcion;
            $this->product->precio = $data->precio;

            if($this->product->create()){
                http_response_code(201);
                echo json_encode(["message" => "Producto creado exitosamente"]); // Corregido
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Producto no creado"]); // Corregido
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos para crear el producto"]); // Corregido
        }
    }
    public function read(){
        $stmt = $this->product->read();
        $num = $stmt->rowCount();
        if($num>0){
            $product_arr=[];
            $product_arr["registros"]=[];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $product_item =[
                    "id"=>$id,
                    "nombre"=>$nombre,
                    "descripcion"=>$descripcion,
                    "precio"=>$precio
                ];
                array_push($product_arr["registros"],$product_item);
            }
            http_response_code(200);
            echo json_encode($product_arr);
        }
        else{
            http_response_code(404);
            echo json_encode(["message"=>"No se encontraron productos"]);
        }
    }
        public function update(){
        $data = json_decode(file_get_contents("php://input"));

        if(!$data){
            http_response_code(400);
            echo json_encode(["message" => "Formato JSON inválido"]);
            return;
        }

        if(!empty($data->nombre) && !empty($data->descripcion) && !empty($data->precio)&& !empty($data->id)){
            $this->product->nombre = $data->nombre;
            $this->product->descripcion = $data->descripcion;
            $this->product->precio = $data->precio;
            $this->product->id = $data->id;

            if($this->product->update()){
                http_response_code(200);
                echo json_encode(["message" => "Actualizado exitosamente"]); // Corregido
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Producto no actualizado"]); // Corregido
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos para crear el producto"]); // Corregido
        }
    }
    public function delete(){
        $data = json_decode(file_get_contents("php://input"));
        if(!empty($data->id)){
            $this->product->id = $data->id;
            if($this->product->delete()){
                http_response_code(200);
                echo json_encode(["message" => "Producto eliminado exitosamente"]); // Corregido
            } else {
                http_response_code(503);
                echo json_encode(["message" => "Producto no eliminado"]); // Corregido
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos para eliminar el producto"]); // Corregido
        }
    }
}
?>
