<?php
include_once "app/models/padresalumnos.php";

class PadresAlumnosController extends Controller
{
    private $padrealumno;
    public function __construct($parametro)
    {
        $this->padrealumno = new PadresAlumnos();
        parent::__construct("padresalumnos", $parametro, true);
    }

    public function getAll()
    {
        $records = $this->padrealumno->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function save()
    {

        if ($_POST["id_padre_alumno"] == 0) {
            $datosPadrealumno = $this->padrealumno->getPadresAlumnosByName($_POST["parentesco"]);
            if (count($datosPadrealumno) > 0) {
                $info = array('success' => false, 'msg' => "El parentesco ya esta asociado.");
            } else {
                $records = $this->padrealumno->save($_POST);
                $info = array('success' => true, 'msg' => "El parentesco se ha guardado con éxito.");
            }
        } else {
            $records = $this->padrealumno->update($_POST);
            $info = array('success' => true, 'msg' => "El parentesco se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOnePadresAlumnos()
    {
        $records = $this->padrealumno->getOnePadresAlumnos($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'El padre no existe.');
        }
        echo json_encode($info);
    }

    public function deletePadresAlumnos()
    {
        $records = $this->padrealumno->deletePadresAlumnos($_GET["id"]);
        $info = array('success' => true, 'msg' => "Se ha eliminado el parentezco con éxito.");
        echo json_encode($info);
    }
}
