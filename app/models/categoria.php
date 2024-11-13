<?php
include_once "app/models/db.class.php";
class Categoria extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_categoria, categoria, id_subcategoria, subcategoria from categoria inner join subcategoria using (id_subcategoria) order by id_categoria");
    }

    public function save($data){
        return $this->executeInsert("Insert into categoria set categoria='{$data["categoria"]}', id_subcategoria='{$data["id_subcategoria"]}'");
    }

    public function getCategoriaByName($categoria){
        return $this->executeQuery("Select id_categoria, categoria from categoria where categoria='{$categoria}'");
    }

    public function getOneCategoria($id) {
        return $this->executeQuery("Select id_categoria, categoria, id_subcategoria from categoria where id_categoria='{$id}'");
    }

    public function update($data) {  
        return $this->executeInsert("update categoria set categoria='{$data["categoria"]}', id_subcategoria='{$data["id_subcategoria"]}' where id_categoria='{$data["id_categoria"]}'");
    }

    public function deleteCategoria ($id) {
        return $this->executeInsert("delete from categoria where id_categoria='$id'");
        
    }
}
