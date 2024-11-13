<?php
include_once "app/models/clientesuser.php";

class ClientesUserController extends Controller {
    private $cliente;
    public function __construct($parametro) {
        $this->cliente=new ClientesUser();
        parent::__construct("clientesuser",$parametro,true);
    }

    public function getAll() {
        $records=$this->cliente->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }
    
    public function save() {
        if ($_POST["id_cliente"]==0) {
            $datosClientes=$this->cliente->getClienteByName($_POST["nombres"]);
            if (count($datosClientes)>0){
                $info=array('success'=>false, 'msg'=>"El cliente ya existe.");
            } else {
                $records=$this->cliente->save($_POST);
                $info=array('success'=>true, 'msg'=>"El cliente se ha guardado con éxito.");
            }
        } else {
            $records=$this->cliente->update($_POST);
            $info=array('success'=>true, 'msg'=>"Los datos del cliente han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneCliente() {
        $records=$this->cliente->getOneCliente($_GET["id"]);
        if (count ($records) > 0 ){
            $info=array('success'=>true, 'records'=>$records);
        } else {
            $info=array('success'=>false, 'msg'=>'El cliente no existe.');
        }
        echo json_encode($info);
    }

    public function deleteCliente(){
        $records=$this->cliente->deleteCliente($_GET["id"]);
        $info=array('success'=>true, 'msg'=>"Se ha eliminado el cliente con éxito.");
        echo json_encode($info);
    }
}