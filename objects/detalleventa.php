  <?php
class DetalleVenta{
    private $conn;
    private $table_name="detalleventa";

    public $id;
    public $id_producto;
    public $venta_id;
    public $productos_id;
    public $cantidad;

    public $created;


    public function __construct($db){
        $this->conn=$db;
    }

        // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id_producto=:id_producto, venta_id=:venta_id, productos_id=:productos_id, cantidad=:cantidad";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        //$this->name=htmlspecialchars(strip_tags($this->name));
        //$this->price=htmlspecialchars(strip_tags($this->price));
        //$this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":id_producto", $this->id_producto);
        $stmt->bindParam(":venta_id", $this->venta_id);
        $stmt->bindParam(":productos_id", $this->productos_id);
        $stmt->bindParam(":cantidad", $this->cantidad);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            echo "<pre>";
                print_r($stmt->errorInfo());
            echo "</pre>";

            return false;
        }
    }

    // read products
    function readAll(){
        // select all query
        $query = "SELECT
                   id,id_producto, venta_id, productos_id, cantidad
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id DESC";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


    // used when filling up the update product form
function readOne(){

    // query to read single record
    $query = "SELECT
                id_producto, venta_id, productos_id, cantidad
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    //id_producto, venta_id, productos_id, cantidad

    $this->id_producto = $row['id_producto'];
    $this->venta_id = $row['venta_id'];
    $this->productos_id= $row['productos_id'];
    $this->cantidad= $row['cantidad'];

}


    // update the product
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            id_producto=:id_producto,
            venta_id=:venta_id,
            productos_id=:productos_id,
            cantidad=:cantidad

            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // posted values
    //$this->name=htmlspecialchars(strip_tags($this->name));
    //$this->price=htmlspecialchars(strip_tags($this->price));
    //$this->description=htmlspecialchars(strip_tags($this->description));

    // bind new values
    $stmt->bindParam(":id_producto", $this->id_producto);
    $stmt->bindParam(":venta_id", $this->venta_id);
    $stmt->bindParam(":productos_id", $this->productos_id);
    $stmt->bindParam(":cantidad", $this->cantidad);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


    // delete the product
function delete(){

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // bind id of record to delete
    $stmt->bindParam(1, $this->id);

    // execute query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}

?>
