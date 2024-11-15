<?php
include_once "app/models/grados.php";

class GradosController extends Controller {
    private $grado;
    public function __construct($parametro) {
        $this->grado=new grados();
        parent::__construct("grados",$parametro,true);
    }

    public function getAll() {
        $records=$this->grado->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }
    
    public function save() {
        if ($_POST["id_grado"]==0) {
            $datosGrados=$this->grado->getGradoByName($_POST["nombre_grado"]);
            if (count($datosGrados)>0){
                $info=array('success'=>false, 'msg'=>"El grado ya existe.");
            } else {
                $records=$this->grado->save($_POST);
                $info=array('success'=>true, 'msg'=>"El grado se ha guardado con éxito.");
            }
        } else {
            $records=$this->grado->update($_POST);
            $info=array('success'=>true, 'msg'=>"Los datos del grado han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneGrado() {
        $records=$this->grado->getOneGrado($_GET["id"]);
        if (count ($records) > 0 ){
            $info=array('success'=>true, 'records'=>$records);
        } else {
            $info=array('success'=>false, 'msg'=>'El grado no existe.');
        }
        echo json_encode($info);
    }

    public function deleteGrado(){
        $records=$this->grado->deleteGrado($_GET["id"]);
        $info=array('success'=>true, 'msg'=>"Se ha eliminado el grado con éxito.");
        echo json_encode($info);
    }
}