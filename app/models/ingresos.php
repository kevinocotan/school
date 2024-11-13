<?php
include_once "app/models/db.class.php";
class Ingresos extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_ingreso, date_format(fecha,'%d-%M-%Y') as fecha, metodopago, c.nombres, d.nombrescliente, d.apellidos, a.descripcion, a.precios, b.nombre, cantidad_producto, comentario, b.precio, b.precio*cantidad_producto as total
        from servicios a inner join (productos b inner join ingresos using(id_producto)
        inner join empleados c using(id_empleado) inner join clientes d using(id_cliente)) using(id_servicio) 
        order by id_ingreso DESC");
    }

    /*public function getIngresoByDate($id_producto,$id_ingreso) {
        return $this->executeQuery("Select COUNT(*) as stock, cantidad_producto from ingresos inner join productos using(id_producto)
        WHERE id_producto='{$id_producto}' and id_ingreso='{$id_ingreso}'");
    }*/

    /*public function getIngresoByDate($id_ingreso,$id_producto) {
        return $this->executeQuery("Select id_ingreso, id_servicio, id_producto, cantidad_producto, id_empleado, fecha, metodopago, comentario, stock from ingresos INNER JOIN productos USING (id_producto)
        WHERE id_ingreso='{$id_ingreso}' and id_producto='{$id_producto}'");
    }*/

    public function getCountProducto($id_producto) {
        return $this->executeQuery("Select stock from productos
        WHERE id_producto='{$id_producto}'");
    }

    public function save($data) {
        return $this->executeInsert("insert into ingresos set fecha='{$data["fecha"]}', metodopago='{$data["metodopago"]}', id_servicio='{$data["id_servicio"]}', id_producto='{$data["id_producto"]}', cantidad_producto='{$data["cantidad_producto"]}', comentario='{$data["comentario"]}', id_empleado='{$data["id_empleado"]}', id_cliente='{$data["id_cliente"]}'");
    }

    public function getOneIngreso($id) {
        return $this->executeQuery("Select id_ingreso, fecha, metodopago, id_servicio, id_producto, cantidad_producto, comentario, id_empleado, id_cliente from ingresos where id_ingreso='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update ingresos set fecha='{$data["fecha"]}', metodopago='{$data["metodopago"]}', id_servicio='{$data["id_servicio"]}', id_producto='{$data["id_producto"]}', cantidad_producto='{$data["cantidad_producto"]}', comentario='{$data["comentario"]}',
        id_empleado='{$data["id_empleado"]}', id_cliente='{$data["id_cliente"]}'
        where id_ingreso='{$data["id_ingreso"]}'");
    }

    public function deleteIngreso($id) {
        return $this->executeInsert("delete from ingresos where id_ingreso='$id'");
    }

    public function getIngresosReporte($data){
        $condicion="";
        if (isset($data["idingreso"])) {
            if ($data["idingreso"]!="0") {
                $condicion.="and fecha='{$data["idingreso"]}'";
            }
        }
        if (isset($data["mes"])) {
            $condicion.="and month(fecha)='{$data["mes"]}' and year(fecha)='{$data["anio"]}'";
        }
        if ($data["idempleado"]!="0") {
            $condicion.="and d.id_empleado='{$data["idempleado"]}'";
        }
        if ($data["idcliente"]!="0") {
            $condicion.="and e.id_cliente='{$data["idcliente"]}'";
        }
        if ($data["metodopago"]!="0") {
            $condicion.="and a.metodopago='{$data["metodopago"]}'";
        }

        return $this->executeQuery("Select id_ingreso, date_format(fecha,'%d-%M-%Y') as fecha, a.metodopago, b.descripcion, b.precios, c.nombre, cantidad_producto, comentario, c.precio, d.nombres, e.nombrescliente, e.apellidos
        from servicios b inner join (productos c inner join ingresos a using(id_producto)
        inner join empleados d using(id_empleado) inner join clientes e using(id_cliente)) using(id_servicio)
        where 1=1 $condicion
        order by fecha");
    }

    public function getProductosReporte($data){
        $condicion="";
        if (isset($data["idingreso"])) {
            if ($data["idingreso"]!="0") {
                $condicion.="and fecha='{$data["idingreso"]}'";
            }
        }
        if (isset($data["mes"])) {
            $condicion.="and month(fecha)='{$data["mes"]}' and year(fecha)='{$data["anio"]}'";
        }
        if ($data["idempleado"]!="0") {
            $condicion.="and d.id_empleado='{$data["idempleado"]}'";
        }

        return $this->executeQuery("Select id_ingreso, date_format(fecha,'%d-%M-%Y') as fecha, metodopago, b.descripcion, b.precios, c.nombre, c.precio, d.nombres, a.comentario
        from servicios b inner join (productos c inner join ingresos a using(id_producto)
        inner join empleados d using(id_empleado)) using(id_servicio)
        where 1=1 $condicion
        order by fecha");
    }

    public function getFechasPorIngresos(){
        return $this->executeQuery("select fecha as id_ingreso, date_format(fecha,'%d-%M-%Y') AS fecha FROM ingresos GROUP BY fecha ORDER BY fecha");
    }
}
