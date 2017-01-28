<?php
class Marca{
    private $conn;
    private $table_name="marca";

    public $id;
    public $descripcion;
    public $descuento;

    public $created;


    public function __construct($db){
        $this->conn=$db;
    }

        // create cupon
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    descripcion=:descripcion, descuento=:descuento";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        //$this->name=htmlspecialchars(strip_tags($this->name));
        //$this->price=htmlspecialchars(strip_tags($this->price));
        //$this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":descuento", $this->precioCompra);

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

    // read cupons
    function readAll(){
        // select all query
        $query = "SELECT
                   id, descripcion, descuento
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


    // used when filling up the update cupon form
function readOne(){

    // query to read single record
    $query = "SELECT
                descripcion, descuento
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of cupon to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    //descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida

    $this->descripcion = $row['descripcion'];
    $this->descuento = $row['descuento'];


}


    // update the cupon
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                descripcion = :descripcion,
                descuento = :descuento
            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // posted values
    //$this->name=htmlspecialchars(strip_tags($this->name));
    //$this->price=htmlspecialchars(strip_tags($this->price));
    //$this->description=htmlspecialchars(strip_tags($this->description));

    // bind new values
    $stmt->bindParam(':descripcion', $this->decripcion);
    $stmt->bindParam(':descuento', $this->descuento);
    $stmt->bindParam(':id', $this->id);

    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}


    // delete the cupon
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
