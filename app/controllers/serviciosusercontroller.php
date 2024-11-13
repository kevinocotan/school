<?php
include_once "app/models/serviciosuser.php";

class ServiciosUserController extends Controller {
    private $servicios;
    public function __construct($parametro) {
        $this->servicios=new ServiciosUser();
        parent::__construct("serviciosuser",$parametro,true);
    }

    public function getAll() {
        $records=$this->servicios->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
    
    public function save() {
        if ($_POST["id_servicio"]=="0") {
            $datosServicio=$this->servicios->getServicioByName($_POST["descripcion"]);
            if (count($datosServicio)>0) {
                $info=array('success'=>false,'msg'=>"El servicio ya existe.");
            } else {
                $records=$this->servicios->save($_POST);
                $info=array('success'=>true,'msg'=>"Servicio guardado con éxito.");
            }
        } else {
            $records=$this->servicios->update($_POST);
            $info=array('success'=>true,'msg'=>"Se han actualizado los datos de servicio con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneServicio() {
		$records=$this->servicios->getOneServicio($_GET["id"]);
		if (count($records)>0) {
			$info=array('success'=>true,'records'=>$records);
		} else {
			$info=array('success'=>false,'msg'=>"El servicio ya existe.");
		}
		echo json_encode($info);
	}

	public function deleteServicio() {
		$records=$this->servicios->deleteServicio($_GET["id"]);
		$info=array('success'=>true,'msg'=>"Se ha eliminado el servicio con éxito.");
		echo json_encode($info);
	}
}
?>