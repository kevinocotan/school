<?php
include_once "app/models/login.php";
class LoginController extends Controller {
    private $user;
    public function __construct($parametro) {
        $this->user=new Login();
        parent::__construct("login",$parametro);
    }

    public function validar() {
        $user=$_POST["usuario"];
        $pass=$_POST["password"];
        $record=$this->user->validarLogin($user,$pass);
        if ($record) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION["id_usr"]=$record["id_usr"];
            $_SESSION["tipo"]=$record["tipo"];
            $_SESSION["usuario"]=$record["usuario"];
            $_SESSION["nuser"]="{$record["nombres"]} {$record["apellidos"]}";
            if ($record["tipo"]=="Administrador") {
                $info=array("success"=>true,"msg"=>"Usuario correcto","url"=>URL."dashboard");
            } else {
                $info=array("success"=>true,"msg"=>"Usuario correcto","url"=>URL."dashboarduser");
            }
        } else {
            $info=array("success"=>false,"msg"=>"Usuario o password incorrecto.");
        }
        echo json_encode($info);
    }

    public function cerrar() {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        $this->view->render("login");
    }
}



