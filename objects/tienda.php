<?php
class Tienda{
    private $conn;
    private $table_name="tienda";

    public $id;
    public $nombre;
    public $domicilio;
    public $estado;

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
                    nombre=:nombre, domicilio=:domicilio, estado=:estado";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        //$this->name=htmlspecialchars(strip_tags($this->name));
        //$this->price=htmlspecialchars(strip_tags($this->price));
        //$this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":domicilio", $this->domicilio);
        $stmt->bindParam(":estado", $this->estado);

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
                   id, nombre, domicilio, estado
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
                nombre, domicilio, estado
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
//nombre=:nombre, domicilio=:domicilio, estado=:estado
    $this->nombre = $row['nombre'];
    $this->domicilio = $row['domicilio'];
    $this->estado= $row['estado'];

}


    // update the product
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                nombre=:nombre, domicilio=:domicilio, estado=:estado
            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // posted values
    //$this->name=htmlspecialchars(strip_tags($this->name));
    //$this->price=htmlspecialchars(strip_tags($this->price));
    //$this->description=htmlspecialchars(strip_tags($this->description));

    // bind new values
    $stmt->bindParam(":nombre", $this->nombre);
    $stmt->bindParam(":domicilio", $this->domicilio);
    $stmt->bindParam(":estado", $this->estado);
    $stmt->bindParam(":id", $this->id);

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
