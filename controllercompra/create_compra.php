<?php
// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once '../objects/compra.php';
$product = new Compra($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$product->cliente_id = $data->cliente_id;
$product->empleado_id = $data->empleado_id;
$product->fecha = date('Y-m-d H:i:s');


// create the product
if($product->create()){
    echo "Producto fue creado.";
}

// if unable to create the product, tell the user
else{
    echo "No se ha podido crear un producto.";
}
?>
