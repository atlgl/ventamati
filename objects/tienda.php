<?php
class Product{
    private $conn;
    private $table_name="productos";

    public $id;
    public $descripcion;
    public $precioCompra;
    public $precioVenta;
    public $departamento_id;
    public $cantidad;
    public $unidadDeMedida;
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
                    descripcion=:descripcion, precioCompra=:precioCompra, precioVenta=:precioVenta, departamento_id=:departamento_id,cantidad=:cantidad,unidadDeMedida=:unidadDeMedida";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        //$this->name=htmlspecialchars(strip_tags($this->name));
        //$this->price=htmlspecialchars(strip_tags($this->price));
        //$this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precioCompra", $this->precioCompra);
        $stmt->bindParam(":precioVenta", $this->precioVenta);
        $stmt->bindParam(":departamento_id", $this->departamento_id);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":unidadDeMedida", $this->unidadDeMedida);

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
                   id, descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
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
                descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida
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
    //descripcion, precioCompra, precioVenta, departamento_id, cantidad, unidadDeMedida

    $this->descripcion = $row['descripcion'];
    $this->precioCompra = $row['precioCompra'];
    $this->precioVenta= $row['precioVenta'];
    $this->departamento_id= $row['departamento_id'];
    $this->cantidad= $row['cantidad'];
    $this->unidadDeMedida= $row['unidadDeMedida'];

}


    // update the product
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                descripcion = :descripcion,
                precioCompra = :precioCompra,
                precioVenta = :precioVenta,
                departamento_id = :departamento_id,
                cantidad = :cantidad,
                unidadDeMedida = :unidadDeMedida
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
    $stmt->bindParam(':precioCompra', $this->precioCompra);
    $stmt->bindParam(':precioVenta', $this->precioVenta);
    $stmt->bindParam(':departamento_id', $this->departamento_id);
    $stmt->bindParam(':cantidad', $this->cantidad);
    $stmt->bindParam(':unidadDeMedida', $this->unidadDeMedida);
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
