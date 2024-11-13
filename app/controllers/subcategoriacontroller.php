<?php
include_once "app/models/subcategoria.php";

class SubcategoriaController extends Controller {
    private $subcategoria;
    public function __construct($parametro) {
        $this->subcategoria=new Subcategoria();
        parent::__construct("subcategoria",$parametro,true);
    }

    public function getAll() {
        $records=$this->subcategoria->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
    public function save() {
        //Proceso para guardar el archivo
        if ($_POST["id_subcategoria"]=="0") {
            $datosSubcategoria=$this->subcategoria->getSubcategoriaByName($_POST["id_subcategoria"]);
            if (count($datosSubcategoria)>0) {
                $info=array('success'=>false,'msg'=>"La subcategoría ya existe.");
            } else {
                $records=$this->subcategoria->save($_POST);
                $info=array('success'=>true,'msg'=>"Subcategoría guardada con éxito.");
            }
            } else {
                $records=$this->subcategoria->update($_POST);
                $info=array('success'=>true, 'msg'=>"Se han actualizado los datos de subcategoría con éxito.");
            }
            echo json_encode($info);
        }

    public function getOneSubcategoria() {
        $records=$this->subcategoria->getOneSubcategoria($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'La subcategoría no existe.');
        }
        echo json_encode($info);
    }

    public function deleteSubcategoria() {
        $records=$this->subcategoria->deleteSubcategoria($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado la ubcategoría eliminada con éxito.");
        echo json_encode($info);
    }
}