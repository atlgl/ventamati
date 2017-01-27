<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/Tienda.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare Tienda object
$tienda = new Tienda($db);

// get id of Tienda to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of Tienda to be edited
$tienda->id = $data->id;

// read the details of Tienda to be edited
$tienda->readOne();
//descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
// create array
$tienda_arr[] = array(
    "id" =>  $tienda->id,
    "nombre" => $tienda->nombre,
    "domicilio" => $tienda->domicilio,
    "estado" => $tienda->estado
);

// make it json format
print_r(json_encode($tienda_arr));
?>
