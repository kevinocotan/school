<?php
include_once "app/models/db.class.php";
class Servicios extends BaseDeDatos {

    public function __construct() {
        parent::conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_servicio, descripcion, precios from servicios order by id_servicio");
    }

    public function getAllOrderByName(){
        return $this->executeQuery("Select id_servicio, descripcion, precios from servicios
        order by descripcion");
        
    }

    public function save($data){
        return $this->executeInsert("Insert into servicios set descripcion='{$data["descripcion"]}', 
        precios='{$data["precios"]}'");
    }

    public function getServicioByName($descripcion){
        return $this->executeQuery("Select id_servicio, descripcion, precios from servicios 
        where descripcion='{$descripcion}'");
    }

    public function getOneServicio($id) {
        return $this->executeQuery("Select id_servicio, descripcion, precios from servicios 
        where id_servicio='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update servicios set descripcion='{$data["descripcion"]}',
        precios='{$data["precios"]}' where id_servicio='{$data["id_servicio"]}'");
    }

    public function deleteServicio ($id) {
        return $this->executeInsert("delete from servicios where id_servicio='$id'");
        
    }
} 