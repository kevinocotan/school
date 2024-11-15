<?php
include_once "app/models/db.class.php";
class Secciones extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_seccion, nombre_seccion from secciones order by id_seccion");
    }

    public function getAllOrderByName(){
        return $this->executeQuery("Select id_seccion, nombre_seccion from secciones order by nombre_seccion");
    }

    public function save($data){
        return $this->executeInsert("Insert into secciones set nombre_seccion='{$data["nombre_seccion"]}'");
    }

    public function getSeccionByName($nombres){
        return $this->executeQuery("Select id_seccion, nombre_seccion from secciones where nombre_seccion='{$nombres}'");
    }

    public function getOneSeccion($id) {
        return $this->executeQuery("Select id_seccion, nombre_seccion from secciones where id_seccion='{$id}'");
    }
    

    public function update($data) {
        return $this->executeInsert("update secciones set nombre_seccion='{$data["nombre_seccion"]}' where id_seccion='{$data["id_seccion"]}'");
    }

    public function deleteSeccion ($id) {
        return $this->executeInsert("delete from secciones where id_seccion='$id'");
        
    }
} 