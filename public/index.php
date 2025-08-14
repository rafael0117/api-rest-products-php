<?php 

require_once "../src/ProductoController.php";

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER["REQUEST_METHOD"];
$productController = new ProductoController();

switch($method){
    case 'POST':
        $productController->create();
        break;
        case 'GET':
        $productController->read();
        break;
        case 'PUT':
        $productController->update();
        break;
        case 'DELETE':
        $productController->delete();
        break;
    default:
    http_response_code(405);
    echo json_encode(["message"=>"Metodo no permitido"]);
    break;


}

?>