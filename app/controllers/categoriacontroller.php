<?php
include_once "app/models/categoria.php";

class CategoriaController extends Controller {
    private $categoria;
    public function __construct($parametro) {
        $this->categoria=new Categoria();
        parent::__construct("categoria",$parametro,true);
    }

    public function getAll() {
        $records=$this->categoria->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }
    public function save() {
        if ($_POST["id_categoria"]==0) {
            $datosCategoria=$this->categoria->getCategoriaByName($_POST["categoria"]);
            if (count($datosCategoria)>0){
                $info=array('success'=>false,'msg'=>"La categoría ya existe.");
            } else {
                $records=$this->categoria->save($_POST);
                $info=array('success'=>true,'msg'=>"La categoría ha sido guardada con éxito.");
            }
        } else {
            $records=$this->categoria->update($_POST);
            $info=array('success'=>true,'msg'=>"Los datos de categoría han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneCategoria() {
        $records=$this->categoria->getOneCategoria($_GET["id"]);
        if (count ($records) > 0 ){
            $info=array('success'=>true, 'records'=>$records);
        } else {
            $info=array('success'=>false, 'msg'=>'La categoría no existe.');
        }
        echo json_encode($info);
    }

    public function deleteCategoria(){
        $records=$this->categoria->deleteCategoria($_GET["id"]);
        $info=array('success'=>true, 'msg'=>"Se ha eliminado la categoría con éxito.");
        echo json_encode($info);
    }
}