<?php
include_once "app/models/secciones.php";

class SeccionesController extends Controller {
    private $seccion;
    public function __construct($parametro) {
        $this->seccion=new secciones();
        parent::__construct("secciones",$parametro,true);
    }

    public function getAll() {
        $records=$this->seccion->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }
    
    public function save() {
        if ($_POST["id_seccion"]==0) {
            $datosSeccion=$this->seccion->getSeccionByName($_POST["nombre_seccion"]);
            if (count($datosSeccion)>0){
                $info=array('success'=>false, 'msg'=>"La sección ya existe.");
            } else {
                $records=$this->seccion->save($_POST);
                $info=array('success'=>true, 'msg'=>"La sección se ha guardado con éxito.");
            }
        } else {
            $records=$this->seccion->update($_POST);
            $info=array('success'=>true, 'msg'=>"Los datos de La sección han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneSeccion() {
        $records=$this->seccion->getOneSeccion($_GET["id"]);
        if (count ($records) > 0 ){
            $info=array('success'=>true, 'records'=>$records);
        } else {
            $info=array('success'=>false, 'msg'=>'La sección no existe.');
        }
        echo json_encode($info);
    }

    public function deleteSeccion(){
        $records=$this->seccion->deleteSeccion($_GET["id"]);
        $info=array('success'=>true, 'msg'=>"Se ha eliminado La sección con éxito.");
        echo json_encode($info);
    }
}