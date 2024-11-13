<?php
include_once "app/models/db.class.php";
class Login extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function validarLogin($user, $pass) {
        $result=$this->conexion->query("SELECT * FROM usuarios WHERE usuario='$user' and password=sha1('$pass')");
        if ($record=$result->fetch_assoc()) {
            return $record;
        } else {
            return false;
        }
    }
}