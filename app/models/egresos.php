<?php
include_once "app/models/db.class.php";
class Egresos extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_egreso, date_format(fecha,'%d-%M-%Y') as fecha, descripcion, monto from egresos order by id_egreso DESC");
    }

    public function getEgresoByDate($id_egreso) {
        return $this->executeQuery("Select id_egreso, fecha, descripcion, monto from egresos where id_egreso='{$id_egreso}'");
    }

    public function save($data) {
        return $this->executeInsert("insert into egresos set fecha='{$data["fecha"]}', descripcion='{$data["descripcion"]}', monto='{$data["monto"]}'");
    }

    public function getOneEgreso($id) {
        return $this->executeQuery("Select id_egreso, fecha, descripcion, monto from egresos where id_egreso='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update egresos set fecha='{$data["fecha"]}', descripcion='{$data["descripcion"]}', monto='{$data["monto"]}'
        where id_egreso='{$data["id_egreso"]}'");
    }

    public function deleteEgreso($id) {
        return $this->executeInsert("delete from egresos where id_egreso='$id'");
    }

    public function getEgresosReporte($data){
        $condicion="";
        if (isset($data["idegreso"])) {
            if ($data["idegreso"]!="0") {
                $condicion.="and fecha='{$data["idegreso"]}'";
            }
        }
        if (isset($data["mes"])) {
            $condicion.="and month(fecha)='{$data["mes"]}' and year(fecha)='{$data["anio"]}'";
        }

        return $this->executeQuery("Select id_egreso, date_format(fecha,'%d-%M-%Y') as fecha, descripcion, monto from egresos
        where 1=1 $condicion
        order by fecha");
    }

    public function getFechasPorEgresos(){
        return $this->executeQuery("select fecha as id_egreso,date_format(fecha,'%d-%M-%Y') AS fecha FROM egresos GROUP BY fecha ORDER BY fecha");
    }
    
}
