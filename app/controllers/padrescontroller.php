<?php
include_once "app/models/padres.php";

class padresController extends Controller
{
    private $padre;
    public function __construct($parametro)
    {
        $this->padre = new padres();
        parent::__construct("padres", $parametro, true);
    }

    public function getAll()
    {
        $records = $this->padre->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function save()
    {
        if ($_POST["id_padre"] == 0) {
            $datosPadres = $this->padre->getPadreByName($_POST["nombres"]);
            if (count($datosPadres) > 0) {
                $info = array('success' => false, 'msg' => "El Padre ya existe.");
            } else {
                $records = $this->padre->save($_POST);
                $info = array('success' => true, 'msg' => "El padre se ha guardado con éxito.");
            }
        } else {
            $records = $this->padre->update($_POST);
            $info = array('success' => true, 'msg' => "Los datos del padre han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOnePadre()
    {
        $records = $this->padre->getOnePadre($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'El padre no existe.');
        }
        echo json_encode($info);
    }

    public function deletePadre()
    {
        $records = $this->padre->deletePadre($_GET["id"]);
        $info = array('success' => true, 'msg' => "Se ha eliminado el padre con éxito.");
        echo json_encode($info);
    }
}
