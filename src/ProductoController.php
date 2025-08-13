<?php

require_once "../config/database.php";
require_once "Product.php";

class ProductController{
    private $db;
    private $product;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($db);
    }
    public function create(){
        $data = json_decode(file_get_contents("php://input"));
    if(!empty($data->nombre) && !empty($data->descripcion) && !empty($data->precio)){

    }
    else{

    }


    }

}