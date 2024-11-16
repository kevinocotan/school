<?php
include_once "app/models/db.class.php";
class escuelas extends BaseDeDatos
{

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll()
    {
        return $this->executeQuery("select a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, date_format(a.fecha,'%d-%M-%Y') as fecha, b.nombres from escuelas a inner join usuarios b on a.id_usr = b.id_usr order by a.id_usr;");
    }
    public function getAllUser()
    {
        return $this->executeQuery("SELECT a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, DATE_FORMAT(a.fecha,'%d-%M-%Y') as fecha, b.nombres FROM escuelas a INNER JOIN usuarios b ON a.id_usr = b.id_usr WHERE b.id_usr = {$_SESSION['id_usr']}");
    }


    public function getEscuelaByName($nombre)
    {
        return $this->executeQuery("Select id_school, nombre, direccion, email, latitud, longitud, fecha, id_usr from escuelas where nombre='{$nombre}'");
    }

    public function save($data, $img)
    {
        return $this->executeInsert("insert into escuelas set nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', fecha='{$data["fecha"]}', id_usr='{$data["id_usr"]}', foto='{$img}'");
    }

    public function getOneEscuela($id)
    {
        return $this->executeQuery("Select id_school, nombre, direccion, email, latitud, longitud, fecha, id_usr, foto from escuelas where id_school='{$id}'");
    }

    public function update($data, $img)
    {
        return $this->executeInsert("update escuelas set nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', fecha='{$data["fecha"]}', id_usr='{$data["id_usr"]}', foto= if('{$img}'='',foto,'{$img}') where id_school={$data["id_school"]}");
    }

    public function deleteEscuela($id)
    {
        return $this->executeInsert("delete from escuelas where id_school='$id'");
    }

    function getEscuelaByUsuarios($id)
    {
        return  $this->executeQuery("select a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, a.fecha, b.id_usr from escuelas a inner join usuarios b on a.id_usr = b.id_usr order by a.id_usr where b.id_usr='{$id}' order by nombre");
    }

    function getEscuelaById($id)
    {
        return  $this->executeQuery("select a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, a.fecha, b.id_usr from escuelas a inner join usuarios b on a.id_usr = b.id_usr where a.id_usr='{$id}' order by nombre");
    }


    /* PARA MAPA */

    public function getEscuelasMapa($ids)
    {
        $id_school = $ids['id_escuela'];
        $query = "SELECT 
                    e.foto AS foto_escuela,
                    e.latitud AS latitud_escuela,
                    e.longitud AS longitud_escuela
                  FROM 
                    escuelas e
                  WHERE
                    e.id_school = $id_school";
        return $this->executeQuery($query);
    }

    public function getAlumnosescuMapa($ids)
    {
        $id_school = $ids['id_escuela'];
        $query = "SELECT 
                    a.nombre_completo AS nombre_alumno,
                    a.latitud AS latitud_alumno,
                    a.longitud AS longitud_alumno
                FROM 
                    alumnos a
                WHERE
                    a.id_school = $id_school";
        return $this->executeQuery($query);
    }


    public function getEscuelasReporte($data)
    {
        $condicion = "";

        // Filtrar por id_school cuando no es "0"
        if (isset($data["id_school"]) && $data["id_school"] != "0") {
            $condicion .= "AND id_school='{$data["id_school"]}'";
        }

        $query = "SELECT id_school, nombre, direccion, email 
                  FROM escuelas
                  WHERE 1=1 $condicion
                  ORDER BY id_school";

        return $this->executeQuery($query);
    }



    public function getFechasPorEscuelas()
    {
        return $this->executeQuery("select fecha as id_school, fecha FROM escuelas GROUP BY fecha ORDER BY fecha");
    }
}
