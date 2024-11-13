<?php
include_once "app/models/db.class.php";
class Citas extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_cita, descripcion, DATE_FORMAT(fecha, '%d-%M-%Y') AS fecha, hora, b.nombres, b.apellidos, nombrescliente, clientes.apellidos AS apellidos_cliente 
        from citas inner join empleados b using (id_empleado) 
        inner join clientes using (id_cliente) 
        ORDER BY id_cita DESC");
    }

    public function getCitaByName($descripcion) {
        return $this->executeQuery("Select id_cita, descripcion, 
        fecha, hora from citas where descripcion='{$descripcion}'");
    }

    public function getTotalCitas($fecha,$hora) {
        return $this->executeQuery("Select count(*) as total from citas where fecha='{$fecha}' and hour(hora)=hour('{$hora}')");
    }

    public function save($data) {
        return $this->executeInsert("insert into citas set id_empleado='{$data["id_empleado"]}', id_cliente='{$data["id_cliente"]}', descripcion='{$data["descripcion"]}', fecha='{$data["fecha"]}', hora='{$data["hora"]}'");
    }

    public function getOneCita($id) {
        return $this->executeQuery("Select id_cita, descripcion, fecha, hora, id_cliente, id_empleado
        from citas where id_cita='{$id}'");
    }
    public function update($data) {
        return $this->executeInsert("update citas set id_empleado='{$data["id_empleado"]}', id_cliente='{$data["id_cliente"]}', 
        descripcion='{$data["descripcion"]}', 
        fecha='{$data["fecha"]}', hora='{$data["hora"]}'
        where id_cita={$data["id_cita"]}");
    }

    public function deleteCita($id) {
        return $this->executeInsert("delete from citas where id_cita='$id'");
    }
}