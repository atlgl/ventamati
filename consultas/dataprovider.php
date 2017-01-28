<?php
class DataProvider{

    private $conn;

    public function __construct($db){
        $this->conn=$db;
    }



    //  Consulta  interesantes 1
    //Consulta que me dice con que departamentos cuenta cada sucursal

    function readDeptoSuc(){
        // select all query
        $query = "SELECT
                   	t.nombre AS nombretienda,
                    d.nombre nombredepartamento
                FROM
                    tienda t
                JOIN departamento d ON t.id = d.tienda_id
                ORDER BY
	               t.nombre";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


    /**Consulta  interesante 2 Query para saber cuales son los 10 productos que se compran mas caro y su inventario */
    function readProductExpencive(){
        // select all query
        $query = "SELECT
                    p.descripcion,
                    p.precioCompra,
                    p.precioVenta,
                    t.nombre tienda,
                    d.nombre departamento,
                    p.cantidad
                FROM
                    productos p
                JOIN departamento d ON d.id = p.id
                JOIN tienda t ON t.id = d.tienda_id
                ORDER BY
                    p.cantidad DESC
                LIMIT 0,
                 10;";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }

    /** Consulta  interesante 3 query para saber que cuales son los 20 productos a los que mas ganancia se tiene por unidad, de acuerdo a cada tienda*/
    function read20ProductGanancia(){
        // select all query
        $query = "SELECT DISTINCT
                    t.nombre as productonombre,
                    d.nombre as deptonombre,
                    p.descripcion,
                    round(
                        p.precioVenta - p.precioCompra,
                        2
                    ) as ganancia
                FROM
                    productos p
                JOIN departamento d ON p.departamento_id = d.id
                JOIN tienda t ON t.id = d.tienda_id
                ORDER BY
                    4 DESC,
                    3 DESC
                LIMIT 0,
                 20";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


/** Consulta  interesante 4 query para saber en que tienda y departamento se tienen los 20 productos de los que se obtiene menos ganancia    */
    function readProductCheap(){
        // select all query
        $query = "SELECT DISTINCT
                    t.nombre as tiendanombre,
                    d.nombre as deptonombre,
                    p.descripcion,
                    round(
                        p.precioVenta - p.precioCompra,
                        2
                    ) as ganancia
                FROM
                    productos p
                JOIN departamento d ON p.departamento_id = d.id
                JOIN tienda t ON t.id = d.tienda_id
                ORDER BY
                    4 ASC,
                    3 DESC
                LIMIT 0,
                 20";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


    /** Consulta  interesante 5 query para saber cuales son los 20 productos de los que menos se tiene en el inventario  */
     function read20MasProductos(){
        // select all query
        $query = "SELECT DISTINCT
                    t.nombre as tiendanombre,
                    d.nombre as deptonombre,
                    p.descripcion,
                    p.cantidad,
                    p.unidadDeMedida
                FROM
                    productos p
                JOIN departamento d ON p.departamento_id = d.id
                JOIN tienda t ON t.id = d.tienda_id
                ORDER BY
                    4 ASC,
                    3 DESC
                LIMIT 0,
                 20";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }

    /** Consulta  interesante 6 query para saber cuales son los 20 productos de los que mas se tiene en el inventario  */
     function read20MenosProductos(){
        // select all query
        $query = "SELECT DISTINCT
                    t.nombre as tiendanombre,
                    d.nombre as deptonombre,
                    p.descripcion,
                    p.cantidad,
                    p.unidadDeMedida
                FROM
                    productos p
                JOIN departamento d ON p.departamento_id = d.id
                JOIN tienda t ON t.id = d.tienda_id
                ORDER BY
                    4 ASC,
                    3 DESC
                LIMIT 0,
                 20";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }

    /** Consulta  interesante 7 Query pasa saber cual es el activo de inversion que se tiene por tienda de acuerdo al inventario total **/

         function readActivoInversio(){
        // select all query
        $query = "SELECT DISTINCT
                    t.nombre,
                    round(sum(p.precioCompra), 2) as cantidad
                FROM
                    productos p
                JOIN departamento d ON p.departamento_id = d.id
                JOIN tienda t ON t.id = d.tienda_id
                GROUP BY
                    1
                ORDER BY
                    2 DESC;";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


    /**   Consulta  interesante 8
query para saber cual sera la ganancia total de cada tienda de acuerdo a su inventario   para todos sus producto   */
function readTotalGanaciaTienda(){
        // select all query
        $query = "SELECT DISTINCT
	t.nombre,
	round(
		sum(
			p.precioVenta - p.precioCompra
		),
		2
	) as precios
FROM
	productos p
JOIN departamento d ON p.departamento_id = d.id
JOIN tienda t ON t.id = d.tienda_id
GROUP BY
	1
ORDER BY
	2 DESC;
";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


    /**
Consulta  interesante 9

Query pasa saber cuales son los empleados de cada tienda y el puesto ordenados por tienda y por puesto */

    function readEmpleadoTienda(){
        // select all query
        $query = "SELECT DISTINCT
                    t.nombre Tienda,
                    e.puesto,
                    p.nombre,
                    p.apat,
                    p.amat
                FROM
                    empleado e
                JOIN persona p ON e.persona_id = p.id
                JOIN tienda t ON t.id = e.tienda_id
                GROUP BY
                    1,
                    2
                ORDER BY
                    1 DESC,
                    2 DESC";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }

    /** Consulta  interesante 10 query pasa saber los emails todos los gerentes de tiendas ordenados por nombre ascendentemente */


    function readEmailGerentes(){
        // select all query
        $query = "SELECT DISTINCT
	t.nombre Tienda,
	e.puesto,
	concat(
		p.nombre,
		' ',
		p.apat,
		' ',
		p.amat
	) nombre,
	p.email
FROM
	empleado e
JOIN persona p ON e.persona_id = p.id
JOIN tienda t ON t.id = e.tienda_id
WHERE
	puesto = 'Gerente'
ORDER BY
	3 ASC";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }

    /**Consulta  interesante 11
Query que nos sirve para saber que clientes existen en sistema y asi como saber hacen compra o no y en que tiendas asi como sus emails
*/

function readClienteCompra(){
        // select all query
        $query = "SELECT DISTINCT
	t.nombre AS Tienda,
	concat(
		p.nombre,
		' ',
		p.apat,
		' ',
		p.amat
	) nombreCliente,
	p.email emailCliente
FROM
	cliente c
LEFT JOIN persona p ON c.persona_id = p.id
LEFT JOIN compra com ON com.cliente_id = c.id
LEFT JOIN empleado emp ON empleado_id = com.empleado_id
LEFT JOIN tienda t ON t.id = emp.tienda_id
GROUP BY
	2,
	1";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }


    /*
Consulta  interesante 12
Query que nos sirbe para saber que provedores estan en sistema adicioinalmente si venden en que tiendas y sus emails
*/

function readProveedoresCompra(){
        // select all query
        $query = "SELECT DISTINCT
	t.nombre Tienda,
	concat(
		p.nombre,
		' ',
		p.apat,
		' ',
		p.amat
	) nombreProvedor,
	c.razonSocial,
	p.email emailProvedor
FROM
	proveedor c
LEFT JOIN persona p ON c.persona_id = p.id
LEFT JOIN venta com ON com.proveedor_id = c.id
LEFT JOIN empleado emp ON empleado_id = com.empleado_id
LEFT JOIN tienda t ON t.id = emp.tienda_id
GROUP BY
	2,
	1";
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        // execute query
        $stmt->execute();
        return $stmt;
    }




}
?>
