<?
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=ISO-8859-1");

// include database and object files
include_once '../config/database.php';
include_once '../consultas/dataprovider.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$datos = new DataProvider($db);


$opc = json_decode(file_get_contents("php://input"));
$opc1=12;
switch($opc1)
{
    case 1:
        $stmt = $datos->readDeptoSuc();
        $num = $stmt->rowCount();
    break;
    case 2:
        $stmt = $datos->readProductExpencive();
        $num = $stmt->rowCount();
    break;
    case 3:
        $stmt = $datos->read20ProductGanancia();
        $num = $stmt->rowCount();
    break;
    case 4:
        $stmt = $datos->readProductCheap();
        $num = $stmt->rowCount();
    break;
    case 5:
        $stmt = $datos->read20MasProductos();
        $num = $stmt->rowCount();
    break;
    case 6:
        $stmt = $datos->read20MenosProductos();
        $num = $stmt->rowCount();
    break;
    case 7:
        $stmt = $datos->readActivoInversio();
        $num = $stmt->rowCount();
    break;
    case 8:
        $stmt = $datos->readTotalGanaciaTienda();
        $num = $stmt->rowCount();
    break;
    case 9:
        $stmt = $datos->readEmpleadoTienda();
        $num = $stmt->rowCount();
    break;
    case 10:
        $stmt = $datos->readEmailGerentes();
        $num = $stmt->rowCount();
    break;
    case 11:
        $stmt = $datos->readClienteCompra();
        $num = $stmt->rowCount();
    break;
    case 12:
        $stmt = $datos->readProveedoresCompra();
        $num = $stmt->rowCount();
    break;
}


// check if more than 0 record found
if($num>0){

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
}
// json format output
print_r(json_encode($result));
print_r($result);
?>
