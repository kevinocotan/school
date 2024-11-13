<?php
include_once "app/models/db.class.php";
class ReporteDiario extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_ingreso, date_format(fecha,'%d-%M-%Y') as fecha, c.nombres, a.descripcion, a.precios, b.nombre, b.precio
        from servicios a inner join (productos b inner join ingresos using(id_producto)
        inner join empleados c using(id_empleado)) using(id_servicio) 
        order by fecha");
    }

    public function getIngresoByDate($id_ingreso) {
        return $this->executeQuery("Select id_ingreso, fecha, id_empleado, id_servicio, id_producto from ingresos where id_ingreso='{$id_ingreso}'");
    }

    public function save($data) {
        return $this->executeInsert("insert into ingresos set fecha='{$data["fecha"]}', id_servicio='{$data["id_servicio"]}', id_producto='{$data["id_producto"]}', id_empleado='{$data["id_empleado"]}'");
    }

    public function getOneIngreso($id) {
        return $this->executeQuery("Select id_ingreso, fecha, id_servicio, id_producto, id_empleado from ingresos where id_ingreso='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update ingresos set fecha='{$data["fecha"]}', id_servicio='{$data["id_servicio"]}', id_producto='{$data["id_producto"]}', 
        id_empleado='{$data["id_empleado"]}'
        where id_ingreso='{$data["id_ingreso"]}'");
    }

    public function deleteIngreso($id) {
        return $this->executeInsert("delete from ingresos where id_ingreso='$id'");
    }

    public function getIngresosReporte($data){
        $condicion="";
        if ($data["idingreso"]!="0") {
            $condicion.="and fecha='{$data["idingreso"]}'";
        }

        return $this->executeQuery("Select a.*, date_format(fecha,'%d-%M-%Y') as fecha, b.descripcion, b.precios, c.nombre, c.precio, d.nombres
        from servicios b inner join (productos c inner join ingresos a using(id_producto)
        inner join empleados d using(id_empleado)) using(id_servicio)
        where 1=1 $condicion
        order by fecha");
    }

    public function getFechasPorIngresos(){
        return $this->executeQuery("select fecha as id_ingreso,date_format(fecha,'%d-%m-%Y') AS fecha FROM ingresos GROUP BY fecha ORDER BY fecha");
    }
}
