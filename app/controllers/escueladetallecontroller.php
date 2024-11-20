<?php
include_once "app/models/escuelas.php"; 

class EscuelaDetalleController extends Controller {
    private $escuela;
    public function __construct($parametro) {
        $this->escuela=new escuelas();
        parent::__construct("escueladetalle",$parametro,true);
    }

    public function getEscuelasMapa() {
        $records=$this->escuela->getEscuelasMapa($_GET);  
        $alum=$this->escuela->getAlumnosescuMapa($_GET);
        $url_imagen = isset($_GET['url_imagen']) ? $_GET['url_imagen'] : "";
        $info=array('success'=>true, 'records'=>$records, 'url_imagen' => $url_imagen, 'alum'=>$alum,);
        echo json_encode($info);
    }

}
 