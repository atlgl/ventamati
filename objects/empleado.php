<?php
class Empleado{
    private $conn;
    private $table_name="empleado";

    public $id;
    public $puesto;
    public $id_jefe;
    public $persona_id;
    public $tienda_id;


    public $nombre;
    public $apat;
    public $amat;
    public $domicilio;


    public function __construct($db){
        $this->conn=$db;
    }

        // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    puesto=:puesto, id_jefe=:id_jefe, persona_id=:persona_id, tienda_id=:tienda_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        //$this->name=htmlspecialchars(strip_tags($this->name));
        //$this->price=htmlspecialchars(strip_tags($this->price));
        //$this->description=htmlspecialchars(strip_tags($this->description));

        // bind values
        $stmt->bindParam(':puesto', $this->puesto);
        $stmt->bindParam(':id_jefe', $this->id_jefe);
        $stmt->bindParam(':persona_id', $this->persona_id);
        $stmt->bindParam(':tienda_id', $this->tienda_id);

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
                   id, puesto, id_jefe, persona_id, tienda_id
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
                puesto, id_jefe, persona_id, tienda_id
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

    $this->puesto = $row['puesto'];
    $this->id_jefe = $row['id_jefe'];
    $this->persona_id= $row['persona_id'];
    $this->tienda_id= $row['tienda_id'];

}


    // update the product
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                puesto= :puesto, id_jefe= :id_jefe, persona_id= :persona_id, tienda_id= :tienda_id
            WHERE
                id = :id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // posted values
    //$this->name=htmlspecialchars(strip_tags($this->name));
    //$this->price=htmlspecialchars(strip_tags($this->price));
    //$this->description=htmlspecialchars(strip_tags($this->description));

    // bind new values
    $stmt->bindParam(':puesto', $this->puesto);
    $stmt->bindParam(':id_jefe', $this->id_jefe);
    $stmt->bindParam(':persona_id', $this->persona_id);
    $stmt->bindParam(':tienda_id', $this->tienda_id);
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
