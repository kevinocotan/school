<?php
include_once "app/models/db.class.php";
class SubcategoriaUser extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_subcategoria, subcategoria 
        from subcategoria order by id_subcategoria");
    }

    public function getSubcategoriaByName($subcategoria) {
        return $this->executeQuery("Select id_subcategoria, subcategoria from subcategoria where subcategoria='{$subcategoria}'");
    }

    public function save($data) {
        return $this->executeInsert("insert into subcategoria set id_subcategoria='{$data["id_subcategoria"]}', subcategoria='{$data["subcategoria"]}'");
    }

    public function getOneSubcategoria($id) {
        return $this->executeQuery("Select id_subcategoria, subcategoria
        from subcategoria where id_subcategoria='{$id}'");
    }
    public function update($data) {
        return $this->executeInsert("update subcategoria set id_subcategoria='{$data["id_subcategoria"]}', 
        subcategoria='{$data["subcategoria"]}'
        where id_subcategoria={$data["id_subcategoria"]}");
    }

    public function deleteSubcategoria($id) {
        return $this->executeInsert("delete from subcategoria where id_subcategoria='$id'");
    }
}