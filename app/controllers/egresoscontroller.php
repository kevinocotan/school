<?php
include_once "app/models/egresos.php";
class EgresosController extends Controller {
    private $egreso;
    public function __construct($parametro) {
        $this->egreso=new Egresos();
        parent::__construct("egresos",$parametro,true);
    }

    public function getAll() {
        $records=$this->egreso->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        if ($_POST["id_egreso"]=="0") {
            $datosEgreso=$this->egreso->getEgresoByDate($_POST["id_egreso"]);
            if (count($datosEgreso)>0) {
                $info=array('success'=>false,'msg'=>"El egreso ya existe.");
            } else {
                $records=$this->egreso->save($_POST);
                $info=array('success'=>true,'msg'=>"Se ha registrado el egreso con éxito.");
            }
        } else {
            $records=$this->egreso->update($_POST);
            $info=array('success'=>true,'msg'=>"Se ha actualizado el egreso con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneEgreso() {
        $records=$this->egreso->getOneEgreso($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El egreso no existe.');
        }
        echo json_encode($info);
    }

    public function deleteEgreso() {
        $records=$this->egreso->deleteEgreso($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el egreso con éxito.");
        echo json_encode($info);
    }

    public function getFechasPorEgresos(){
        $records=$this->egreso->getFechasPorEgresos();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
}