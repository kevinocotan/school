<?php
include_once "app/models/db.class.php";
class proveedores extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_proveedor, nombres, apellidos, empresa, telefono, direccion, correo from proveedores order by id_proveedor");
    }

    public function getProveedorByName($nombres) {
        return $this->executeQuery("Select id_proveedor, nombres, apellidos, empresa, telefono, direccion, correo from proveedores where nombres='{$nombres}'");
    }

    public function save($data) {
        return 
        $this->executeInsert("insert into proveedores set nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', empresa='{$data["empresa"]}', telefono='{$data["telefono"]}', direccion='{$data["direccion"]}', correo='{$data["correo"]}'");
    }

    public function getOneProveedor($id) {
        return $this->executeQuery("Select id_proveedor, nombres, apellidos, empresa, telefono, direccion, correo from proveedores where id_proveedor='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update proveedores set nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', empresa='{$data["empresa"]}', telefono='{$data["telefono"]}', direccion='{$data["direccion"]}', correo='{$data["correo"]}' where id_proveedor={$data["id_proveedor"]}");
    }

    public function deleteProveedor ($id) {
        return $this->executeInsert("delete from proveedores where id_proveedor='$id'");
        
    }
}