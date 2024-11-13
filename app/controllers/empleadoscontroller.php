<?php
include_once "app/models/empleados.php";

class EmpleadosController extends Controller {
    private $empleado;
    public function __construct($parametro) {
        $this->empleado=new Empleados();
        parent::__construct("empleados",$parametro,true);
    }

    public function getAll() {
        $records=$this->empleado->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        //Proceso para guardar el archivo
        if ($_POST["id_empleado"]==0) {
            $datosEmpleado=$this->empleado->getEmpleadoByName($_POST["nombres"]);
            if (count($datosEmpleado)>0){
                $info=array('success'=>false, 'msg'=>"El empleado ya existe.");
            } else {
                $records=$this->empleado->save($_POST);
                $info=array('success'=>true, 'msg'=>"El empleado se ha guardado con éxito.");
            }
        } else {
            $records=$this->empleado->update($_POST);
            $info=array('success'=>true, 'msg'=>"Los datos del empleado se han actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneEmpleado() {
        $records=$this->empleado->getOneEmpleado($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El empleado no existe.');
        }
        echo json_encode($info);
    }

    public function deleteEmpleado() {
        $records=$this->empleado->deleteEmpleado($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el empleado con éxito.");
        echo json_encode($info);
    }
}