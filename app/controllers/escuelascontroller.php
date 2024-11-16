<?php
include_once "app/models/escuelas.php";

class EscuelasController extends Controller {
    private $escuela;
    public function __construct($parametro) {
        $this->escuela=new Escuelas();
        parent::__construct("escuelas",$parametro,true);
    }

   public function getAll() {
        $records=$this->escuela->getAll();
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

        if ($_POST["id_school"]==0) {
            $datosEscuela=$this->escuela->getEscuelaByName($_POST["nombre"]);
            if (count($datosEscuela)>0){
                $info=array('success'=>false, 'msg'=>"La escuela ya existe.");
            } else {
                $records=$this->escuela->save($_POST,$img);
                $info=array('success'=>true, 'msg'=>"La escuela se ha guardado con éxito.");
            }
        } else {
            $records=$this->escuela->update($_POST,$img);
            $info=array('success'=>true, 'msg'=>"la escuela se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneEscuela() {
        $records=$this->escuela->getOneEscuela($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'La escuela no existe.');
        }
        echo json_encode($info);
    }

    public function deleteEscuela() {
        $records=$this->escuela->deleteEscuela($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Se ha eliminado la escuela con éxito.");
        echo json_encode($info);
    }

   
}