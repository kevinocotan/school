<?php
include_once "app/models/parentescos.php";

class ParentescosController extends Controller
{
    private $parentesco;
    public function __construct($parametro)
    {
        $this->parentesco = new parentescos();
        parent::__construct("parentescos", $parametro, true);
    }

    public function getAll()
    {
        $records = $this->parentesco->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function save()
    {
        if ($_POST["id_padre_alumno"] == 0) {
            $datosParentesco = $this->parentesco->getParentescoByName($_POST["parentesco"]);
            if (count($datosParentesco) > 0) {
                $info = array('success' => false, 'msg' => "La sección ya existe.");
            } else {
                $records = $this->parentesco->save($_POST);
                $info = array('success' => true, 'msg' => "La sección se ha guardado con éxito.");
            }
        } else {
            $records = $this->parentesco->update($_POST);
            $info = array('success' => true, 'msg' => "Los datos de La sección han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneParentesco()
    {
        $records = $this->parentesco->getOneParentesco($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'La sección no existe.');
        }
        echo json_encode($info);
    }

    public function deleteParentesco()
    {
        $records = $this->parentesco->deleteParentesco($_GET["id"]);
        $info = array('success' => true, 'msg' => "Se ha eliminado La sección con éxito.");
        echo json_encode($info);
    }
}
