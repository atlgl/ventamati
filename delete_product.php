<?php
// include database and object file
include_once 'config/database.php';
include_once 'objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// get product id
$data = json_decode(file_get_contents("php://input"));

// set product id to be deleted
$product->id = $data->id;

// delete the product
if($product->delete()){
    echo "Producto fue eliminado.";
}

// if unable to delete the product
else{
    echo "No se puede eliminar el objeto.";
}
?>
