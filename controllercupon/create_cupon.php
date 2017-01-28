<?php
// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate cupon object
include_once '../objects/cupon.php';
$cupon = new Cupon($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set cupon property values
$cupon->descripcion = $data->descripcion;
$cupon->precioCompra = $data->descuento;
//$cupon->created = date('Y-m-d H:i:s');

// create the cupon
if($cupon->create()){
    echo "Cupon fue creado.";
}

// if unable to create the cupon, tell the user
else{
    echo "No se ha podido crear un cupon.";
}
?>
