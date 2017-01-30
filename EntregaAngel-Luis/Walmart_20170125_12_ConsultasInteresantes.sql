

/*
Consulta  interesantes 1

Consulta que me dice con que departamentos cuenta cada sucursal */
select t.nombre as nombreTienda, d.nombre nombreDepartamento from tienda t join departamento d on t.id = d.tienda_id order by t.nombre;

/**
Consulta  interesante 2

 Query para saber cuales son los 10 productos que se compran mas caro y su inventario */
select p.descripcion, p.precioCompra,p.precioVenta, t.nombre tienda,d.nombre departamento, p.cantidad from productos p
join departamento d on d.id = p.id
join tienda t on t.id = d.tienda_id
order by  p.cantidad  desc  LIMIT 0, 10	;

/**
Consulta  interesante 3

query para saber que cuales son los 20 productos a los que mas ganancia se tiene por unidad, de acuerdo a cada tienda    */

select distinct t.nombre, d.nombre, p.descripcion, round(p.precioVenta-p.precioCompra,2)   from productos p join departamento d on p.departamento_id = d.id
join tienda t on t.id = d.tienda_id

order by 4  desc, 3 desc  limit 0,20;


/**
Consulta  interesante 4

query para saber en que tienda y departamento se tienen los 20 productos de los que se obtiene menos ganancia    */


select distinct t.nombre, d.nombre, p.descripcion, round(p.precioVenta-p.precioCompra,2)   from productos p join departamento d on p.departamento_id = d.id
join tienda t on t.id = d.tienda_id

order by 4  asc, 3 desc  limit 0,20;


/**
Consulta  interesante 5

query para saber cuales son los 20 productos de los que menos se tiene en el inventario  */


select distinct t.nombre, d.nombre, p.descripcion, p.cantidad , p.unidadDeMedida   from productos p join departamento d on p.departamento_id = d.id
join tienda t on t.id = d.tienda_id
order by 4  asc, 3 desc  limit 0,20;

/**
Consulta  interesante 6

query para saber cuales son los 20 productos de los que mas se tiene en el inventario  */

select distinct t.nombre, d.nombre, p.descripcion, p.cantidad , p.unidadDeMedida  from productos p join departamento d on p.departamento_id = d.id
join tienda t on t.id = d.tienda_id
order by 4  desc, 3 desc  limit 0,20;

/**
Consulta  interesante 7

Query pasa saber cual es el activo de inversion que se tiene por tienda de acuerdo al inventario total **/

select distinct t.nombre,  round(sum(p.precioCompra),2)  from productos p join departamento d on p.departamento_id = d.id
join tienda t on t.id = d.tienda_id
group by 1
order by 2 desc;


/**
Consulta  interesante 8

query para saber cual sera la ganancia total de cada tienda de acuerdo a su inventario   para todos sus producto   */

select distinct t.nombre,  round(sum(p.precioVenta-p.precioCompra),2)  from productos p join departamento d on p.departamento_id = d.id
join tienda t on t.id = d.tienda_id
group by 1
order by 2 desc;

/**
Consulta  interesante 9

Query pasa saber cuales son los empleados de cada tienda y el puesto ordenados por tienda y por puesto */

select distinct t.nombre Tienda, e.puesto, p.nombre, p.apat, p.amat  from empleado e join persona p on e.persona_id = p.id
join tienda t on t.id =  e.tienda_id
group by 1,2
order by 1 desc, 2 desc;


/**
Consulta  interesante 10

query pasa saber los emails todos los gerentes de tiendas ordenados por nombre ascendentemente */


select distinct t.nombre Tienda, e.puesto, concat( p.nombre,' ', p.apat,' ', p.amat) nombre , p.email from empleado e join persona p on e.persona_id = p.id
join tienda t on t.id =  e.tienda_id
where puesto= 'Gerente'
order by 3 asc;

/**

Consulta  interesante 11
Query que nos sirbe para saber que clientes existen en sistema y asi como saber hacen compra o no y en que tiendas asi como sus emails
*/

select distinct t.nombre Tienda,  concat( p.nombre,' ', p.apat,' ', p.amat) nombreCliente , p.email emailCliente
from cliente c
left join persona p on c.persona_id = p.id
left join compra com on com.cliente_id = c.id
left join empleado emp on empleado_id = com.empleado_id
left join tienda t on t.id = emp.tienda_id
group by 2,1;

/*
Consulta  interesante 12
Query que nos sirbe para saber que provedores estan en sistema adicioinalmente si venden en que tiendas y sus emails
*/
select distinct t.nombre Tienda,  concat( p.nombre,' ', p.apat,' ', p.amat) nombreProvedor , c.razonSocial, p.email emailProvedor
from proveedor c
left join persona p on c.persona_id = p.id
left join venta com on com.proveedor_id = c.id
left join empleado emp on empleado_id = com.empleado_id
left join tienda t on t.id = emp.tienda_id
group by 2,1;
