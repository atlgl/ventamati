<?php
// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate Tienda object
include_once '../objects/Tienda.php';
$tienda = new Tienda($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set Tienda property values
$tienda->nombre = $data->nombre;
$tienda->domicilio = $data->domicilio;
$tienda->estado = $data->estado;

//$Tienda->created = date('Y-m-d H:i:s');

// create the Tienda
if($tienda->create()){
    echo "Tiendao fue creado.";
}

// if unable to create the Tienda, tell the user
else{
    echo "No se ha podido crear un Tiendao.";
}
?>
