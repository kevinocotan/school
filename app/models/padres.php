<?php
include_once "app/models/db.class.php";
class Padres extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_padre, nombre, direccion, telefono from padres order by id_padre");
    }

    public function getAllOrderByName(){
        return $this->executeQuery("Select id_padre, nombre, direccion, telefono from padres order by nombre");
    }

    public function save($data){
        return $this->executeInsert("Insert into padres set nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', telefono='{$data["telefono"]}'");
    }

    public function getPadreByName($nombres){
        return $this->executeQuery("Select id_padre, nombre, direccion, telefono from padres where nombre='{$nombres}'");
    }

    public function getOnePadre($id) {
        return $this->executeQuery("Select id_padre, nombre, direccion, telefono from padres where id_padre='{$id}'");
    }
    

    public function update($data) {
        return $this->executeInsert("update padres set nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', telefono='{$data["telefono"]}' where id_padre='{$data["id_padre"]}'");
    }

    public function deletePadre ($id) {
        return $this->executeInsert("delete from padres where id_padre='$id'");
        
    }
} 