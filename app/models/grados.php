<?php
include_once "app/models/db.class.php";
class Grados extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_grado, nombre_grado from grados order by id_grado");
    }

    public function getAllOrderByName(){
        return $this->executeQuery("Select id_grado, nombre_grado from grados order by nombre_grado");
    }

    public function save($data){
        return $this->executeInsert("Insert into grados set nombre_grado='{$data["nombre_grado"]}'");
    }

    public function getGradoByName($nombres){
        return $this->executeQuery("Select id_grado, nombre_grado from grados where nombre_grado='{$nombres}'");
    }

    public function getOneGrado($id) {
        return $this->executeQuery("Select id_grado, nombre_grado from grados where id_grado='{$id}'");
    }
    

    public function update($data) {
        return $this->executeInsert("update grados set nombre_grado='{$data["nombre_grado"]}' where id_grado='{$data["id_grado"]}'");
    }

    public function deleteGrado ($id) {
        return $this->executeInsert("delete from grados where id_grado='$id'");
        
    }
} 