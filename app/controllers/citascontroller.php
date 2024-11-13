<?php
include_once "app/models/citas.php";
class CitasController extends Controller {
    private $cita;
    public function __construct($parametro) {
        $this->cita=new Citas();
        parent::__construct("citas",$parametro,true);
    }

    public function getAll() {
        $records=$this->cita->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
    
    public function save() {
        //Proceso para guardar el archivo
        if ($_POST["id_cita"]=="0") {
            $datosCita=$this->cita->getTotalCitas($_POST["fecha"],$_POST["hora"]);
            if ($datosCita[0]["total"]>=5) {
                $info=array('success'=>false,'msg'=>"El cupo para realizar una cita a esta hora está lleno");
            } else {
                $records=$this->cita->save($_POST);
                $info=array('success'=>true,'msg'=>"La cita se ha guardado con éxito.");
            }
            } else {
                $records=$this->cita->update($_POST);
                $info=array('success'=>true, 'msg'=>"Los datos de la cita han sido actualizados con éxito.");
            }
            echo json_encode($info);
        }
    
    // Función para verificar el intervalo de 30 minutos entre citas
    private function isIntervaloCitasValido($horaNueva, $horaAnterior) {
        $horaNueva = strtotime($horaNueva);
        $horaAnterior = strtotime($horaAnterior);
        $diferencia = $horaNueva - $horaAnterior;
        $intervaloMinutos = floor($diferencia / 60);
        return $intervaloMinutos >= 30;
    }

    public function getOneCita() {
        $records=$this->cita->getOneCita($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'La cita no existe.');
        }
        echo json_encode($info);
    }

    public function deleteCita() {
        $records=$this->cita->deleteCita($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado la cita con éxito.");
        echo json_encode($info);
    }
}