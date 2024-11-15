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
        // Comprobar si ya existe la relación entre el alumno y el padre
        $existeRelacion = $this->parentesco->checkIfExist($_POST["id_alumno"], $_POST["id_padre"]);

        if ($existeRelacion) {
            // Si ya existe la relación, no insertamos el nuevo parentesco
            $info = array('success' => false, 'msg' => "El parentesco para este alumno y padre ya existe.");
        } else {
            // Si no existe la relación, insertamos el parentesco
            if ($_POST["id_padre_alumno"] == 0) {
                $records = $this->parentesco->save($_POST);
                $info = array('success' => true, 'msg' => "El parentesco se ha guardado con éxito.");
            } else {
                $records = $this->parentesco->update($_POST);
                $info = array('success' => true, 'msg' => "Los datos del parentesco han sido actualizados con éxito.");
            }
        }

        echo json_encode($info);
    }


    public function getOneParentesco()
    {
        $records = $this->parentesco->getOneParentesco($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'El parentesto no existe.');
        }
        echo json_encode($info);
    }

    public function deleteParentesco()
    {
        $records = $this->parentesco->deleteParentesco($_GET["id"]);
        $info = array('success' => true, 'msg' => "Se ha eliminado el parentesto con éxito.");
        echo json_encode($info);
    }
}
