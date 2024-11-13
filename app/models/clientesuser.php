<?php
include_once "app/models/db.class.php";
class ClientesUser extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("Select id_cliente, nombrescliente, apellidos, telefono, direccion from clientes order by id_cliente");
    }

    public function getAllOrderByName(){
        return $this->executeQuery("Select id_cliente, nombrescliente, apellidos, telefono, direccion from clientes order by nombres");
    }

    public function save($data){
        return $this->executeInsert("Insert into clientes set nombrescliente='{$data["nombrescliente"]}', apellidos='{$data["apellidos"]}', telefono='{$data["telefono"]}', direccion='{$data["direccion"]}'");
    }

    public function getClienteByName($nombres){
        return $this->executeQuery("Select id_cliente, nombrescliente, apellidos, telefono, direccion from clientes where nombrescliente='{$nombres}'");
    }

    public function getOneCliente($id) {
        return $this->executeQuery("Select id_cliente, nombrescliente, apellidos, telefono, direccion from clientes where id_cliente='{$id}'");
    }

    public function update($data) {
        return $this->executeInsert("update clientes set nombrescliente='{$data["nombrescliente"]}', apellidos='{$data["apellidos"]}', telefono='{$data["telefono"]}', direccion='{$data["direccion"]}' where id_cliente='{$data["id_cliente"]}'");
    }

    public function deleteCliente ($id) {
        return $this->executeInsert("delete from clientes where id_cliente='$id'");
        
    }
} 