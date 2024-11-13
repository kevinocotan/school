<?php
include_once "app/models/db.class.php";
class usuarios extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, tipo from usuarios order by id_usr");
    }

    public function getAllOrderByName(){
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, tipo from usuarios order by nombres");
    }

    public function save($data, $img){
        return $this->executeInsert("Insert into usuarios set usuario='{$data["usuario"]}', password=sha1('{$data["password"]}'), nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', tipo='{$data["tipo"]}', foto='{$img}'");
    }

    public function getUserByName($user){
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, tipo from usuarios where usuario='{$user}'");
    }

    public function getOneUser($id) {
        return $this->executeQuery("Select id_usr, nombres, apellidos, usuario, tipo, foto from usuarios where id_usr='{$id}'");
    }

    public function update($data, $img) {
        return $this->executeInsert("update usuarios set usuario='{$data["usuario"]}', 
        password=if('{$data["password"]}'='',password,sha1('{$data["password"]}')), 
        nombres='{$data["nombres"]}', apellidos='{$data["apellidos"]}', tipo='{$data["tipo"]}', 
        foto=if('{$img}'='',foto,'{$img}')
        where id_usr={$data["id_usr"]}");
    }

    public function deleteUser ($id) {
        return $this->executeInsert("delete from usuarios where id_usr='$id'");
        
    }
}
