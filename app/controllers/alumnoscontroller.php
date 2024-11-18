<?php
include_once "app/models/alumnos.php";

class AlumnosController extends Controller {
    private $alumno;
    
    public function __construct($parametro) {
        $this->alumno=new alumnos();
        parent::__construct("alumnos",$parametro,true);
    }

    public function getAll() {
        $records=$this->alumno->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }

    public function save() {
        $img="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                if (($_FILES["foto"]["type"]=="image/png") ||
                    ($_FILES["foto"]["type"]=="image/jpeg")) {
                        copy($_FILES["foto"]["tmp_name"],
                        __DIR__."/../../public_html/fotos/".$_FILES["foto"]["name"])
                        or die("No se pudo copiar el archivo");
                        $img=URL."public_html/fotos/".$_FILES["foto"]["name"];
                    }
            }
        }
        if ($_POST["id_alumno"]==0) {
            $datosAlumno=$this->alumno->getAlumnoByName($_POST["nombre_completo"]);
            if (count($datosAlumno)>0){
                $info=array('success'=>false, 'msg'=>"El alumno ya existe.");
            } else {
                $records=$this->alumno->save($_POST,$img);
                $info=array('success'=>true, 'msg'=>"El alumno se ha guardado con éxito.");
            }
        } else {
            $records=$this->alumno->update($_POST,$img);
            $info=array('success'=>true, 'msg'=>"El alumno se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneAlumno() {
        $records=$this->alumno->getOneAlumno($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El alumno no existe.');
        }
        echo json_encode($info);
    }

    public function deleteAlumno() {
        $records=$this->alumno->deleteAlumno($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado el alumno con éxito.");
        echo json_encode($info);
    }
}