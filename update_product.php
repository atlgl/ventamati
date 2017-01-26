<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$product->id = $data->id;

// set product property values
//descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
$product->descripcion = $data->descripcion;
$product->precioCompra = $data->precioCompra;
$product->precioVenta = $data->precioVenta;
$product->departamento_id = $data->departamento_id;
$product->cantidad = $data->cantidad;
$product->unidadDeMedida = $data->unidadDeMedida;


// update the product
if($product->update()){
    echo "Product was updated.";
}

// if unable to update the product, tell the user
else{
    echo "Unable to update product.";
}
?>
