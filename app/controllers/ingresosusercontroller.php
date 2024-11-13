<?php
include_once "app/models/ingresosuser.php";
class IngresosUserController extends Controller {
    private $ingreso;
    public function __construct($parametro) {
        $this->ingreso=new IngresosUser();
        parent::__construct("ingresosuser",$parametro,true);
    }

    public function getAll() {
        $records=$this->ingreso->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        if ($_POST["id_ingreso"]=="0") {
            $datosIngreso = $this->ingreso->getCountProducto($_POST["id_producto"]);
            $stock = $datosIngreso[0]["stock"];
            if ($stock < $_POST["cantidad_producto"]) {
                $info=array('success'=>false,'msg'=>"La cantidad ingresada es mayor al stock del producto seleccionado.");
            } else {
                $records=$this->ingreso->save($_POST);
                $info=array('success'=>true,'msg'=>"Se ha guardado el ingreso con éxito.");
            }
        } else {
            $records=$this->ingreso->update($_POST);
            $info=array('success'=>true,'msg'=>"Se han actualizado los datos de ingreso con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneIngreso() {
        $records=$this->ingreso->getOneIngreso($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El ingreso no existe.');
        }
        echo json_encode($info);
    }

    public function deleteIngreso() {
        $records=$this->ingreso->deleteIngreso($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el ingreso con éxito.");
        echo json_encode($info);
    }

    public function getFechasPorIngresos(){
        $records=$this->ingreso->getFechasPorIngresos();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
}