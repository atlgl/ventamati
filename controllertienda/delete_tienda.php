<?php
// include database and object file
include_once '../config/database.php';
include_once '../objects/Tienda.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare Tienda object
$tienda = new Tienda($db);

// get Tienda id
$data = json_decode(file_get_contents("php://input"));

// set Tienda id to be deleted
$tienda->id = $data->id;

// delete the Tienda
if($tienda->delete()){
    echo "Tiendao fue eliminado.";
}

// if unable to delete the Tienda
else{
    echo "No se puede eliminar el objeto.";
}
?>
