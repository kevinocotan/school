<?php
include_once "app/models/db.class.php";
class empleados extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_empleado, empleados.nombres, empleados.apellidos, telefono, direccion, dui, sueldo, date_format(fecha_nacimiento,'%d-%M-%Y') as fecha_nacimiento, correo, cargo, usuario from empleados inner join usuarios using (id_usr) order by id_empleado");
    }

    public function getEmpleadoByName($nombres) {
        return $this->executeQuery("Select id_empleado, nombres, apellidos, telefono, direccion, dui, sueldo, fecha_nacimiento, correo, cargo, id_usr from empleados where nombres='{$nombres}'");
    }

    public function save($data) {
        return $this->executeInsert("insert into empleados set nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', telefono='{$data["telefono"]}', direccion='{$data["direccion"]}', dui='{$data["dui"]}', sueldo='{$data["sueldo"]}', fecha_nacimiento='{$data["fecha_nacimiento"]}', correo='{$data["correo"]}', cargo='{$data["cargo"]}', id_usr='{$data["id_usr"]}'");
    }

    public function getOneEmpleado($id) {
        return $this->executeQuery("Select id_empleado, nombres, apellidos, telefono, direccion, dui, sueldo, fecha_nacimiento, correo, cargo, id_usr from empleados where id_empleado='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update empleados set nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', telefono='{$data["telefono"]}', direccion='{$data["direccion"]}', dui='{$data["dui"]}', sueldo='{$data["sueldo"]}', fecha_nacimiento='{$data["fecha_nacimiento"]}', correo='{$data["correo"]}', cargo='{$data["cargo"]}', id_usr='{$data["id_usr"]}' where id_empleado='{$data["id_empleado"]}'");
    }

    public function deleteEmpleado($id) {
        return $this->executeInsert("delete from empleados where id_empleado='$id'");
    }
}