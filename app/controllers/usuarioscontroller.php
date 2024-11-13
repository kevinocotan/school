<?php
include_once "app/models/usuarios.php";

class UsuariosController extends Controller {
    private $user;
    public function __construct($parametro) {
        $this->user=new Usuarios();
        parent::__construct("usuarios",$parametro,true);
    }

    public function getAll() {
        $records=$this->user->getAll();
        $info=array('success'=>true, 'records'=>$records);
        echo json_encode($info);
    }
    
    public function save() {
        $img="";
        //Proceso para guardar el archivo
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                if (($_FILES["foto"]["type"]=="image/png") || ($_FILES["foto"]["type"]=="image/jpeg")) {
                    copy($_FILES["foto"]["tmp_name"],__DIR__."/../../public_html/fotos/".$_FILES["foto"]["name"]) or die ("No se pudo copiar el archivo");
                    $img=URL."/public_html/fotos/".$_FILES["foto"]["name"];
                }
            }
        }
        if ($_POST["id_usr"]==0) {
            $datosUser=$this->user->getUserbyName($_POST["usuario"]);
            if (count($datosUser)>0){
                $info=array('success'=>false, 'msg'=>"El usuario ya existe.");
            } else {
                $records=$this->user->save($_POST,$img);
                $info=array('success'=>true, 'msg'=>"Se ha guardado el usuario con éxito.");
            }
        } else {
            $records=$this->user->update($_POST,$img);
            $info=array('success'=>true, 'msg'=>"Se han actualizado los datos del usuario con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneUser() {
        $records=$this->user->getOneUser($_GET["id"]);
        if (count ($records) > 0 ){
            $info=array('success'=>true, 'records'=>$records);
        } else {
            $info=array('success'=>false, 'msg'=>'El usuario no existe.');
        }
        echo json_encode($info);
    }

    public function deleteUser(){
        $records=$this->user->deleteUser($_GET["id"]);
        $info=array('success'=>true, 'msg'=>"Se ha eliminado el usuario con éxito.");
        echo json_encode($info);
    }
}