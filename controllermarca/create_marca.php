<?php
// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate marca object
include_once '../objects/marca.php';
$marca = new Marca($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set cupon property values
$marca->descripcion = $data->descripcion;
$marca->precioCompra = $data->descuento;
//$marca->created = date('Y-m-d H:i:s');

// create the cupon
if($marca->create()){
    echo "marca fue creado.";
}

// if unable to create the cupon, tell the user
else{
    echo "No se ha podido crear un cupon.";
}
?>
