<?php
// get database connection
include_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

// instantiate Empleado object
include_once '../objects/Empleado.php';
$emp = new Empleado($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set Empleado property values
$emp->nombre = $data->nombre;
$emp->domicilio = $data->domicilio;
$emp->estado = $data->estado;

//$Empleado->created = date('Y-m-d H:i:s');

// create the Empleado
if($emp->create()){
    echo "Empleadoo fue creado.";
}

// if unable to create the Empleado, tell the user
else{
    echo "No se ha podido crear un Empleadoo.";
}
?>
