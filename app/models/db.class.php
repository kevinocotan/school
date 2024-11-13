<?php
class BaseDeDatos {
    //Propiedades
    protected $conexion;
    protected $isConnected=false;
    //Metodos
    public function conectar()   {
        $this->conexion=new mysqli("localhost","userschool","catolica","school");
        if ($this->conexion->connect_errno) {
            echo "Error en conexion:".$this->conexion->connect_error;
            $this->isConnected=false;
        } else {
            $this->isConnected=true;
        }
        return $this->isConnected;
    }

    protected function executeQuery($query) {
        $result=$this->conexion->query($query);
        echo $this->conexion->error;
        $records=array();
        while ($record=$result->fetch_assoc()){
            $records[]=$record;
        }
        return $records;
    }

    protected function executeInsert($query) {
        $result=$this->conexion->query($query);
        echo $this->conexion->error;
        return $this-> conexion-> insert_id;
    }
}