<?php
class Database{

    // specify your own database credentials
    //private $host = "208.43.193.211";
    //private $db_name = "legionxc_walmart";
    //private $username = "legionxc_alumnos";
    //private $password = "hUQ#b0M?l9h(";

    private $host = "localhost";
    private $db_name = "walmart";
    private $username = "root";
    private $password = "mysql";
    //public $conn;

    // get the database connection
    public function getConnection(){ $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name.";charset=UTF8", $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
