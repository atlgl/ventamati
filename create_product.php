<?php
// get database connection
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate product object
include_once 'objects/product.php';
$product = new Product($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$product->descripcion = $data->descripcion;
$product->precioCompra = $data->precioCompra;
$product->precioVenta = $data->precioVenta;
$product->departamento_id = $data->departamento_id;
$product->cantidad = $data->cantidad;
$product->unidadDeMedida = $data->unidadDeMedida;
//$product->created = date('Y-m-d H:i:s');

// create the product
if($product->create()){
    echo "Producto fue creado.";
}

// if unable to create the product, tell the user
else{
    echo "No se ha podido crear un producto.";
}
?>
