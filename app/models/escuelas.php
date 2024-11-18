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
        return $this->executeQuery("select a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, b.nombres from escuelas a inner join usuarios b on a.id_usr = b.id_usr order by a.id_usr;");
    }
    public function getAllUser()
    {
        return $this->executeQuery("SELECT a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, b.nombres FROM escuelas a INNER JOIN usuarios b ON a.id_usr = b.id_usr WHERE b.id_usr = {$_SESSION['id_usr']}");
    }


    public function getEscuelaByName($nombre)
    {
        return $this->executeQuery("Select id_school, nombre, direccion, email, latitud, longitud, id_usr from escuelas where nombre='{$nombre}'");
    }

    public function save($data, $img)
    {
        return $this->executeInsert("insert into escuelas set nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', id_usr='{$data["id_usr"]}', foto='{$img}'");
    }

    public function getOneEscuela($id)
    {
        return $this->executeQuery("Select id_school, nombre, direccion, email, latitud, longitud, id_usr, foto from escuelas where id_school='{$id}'");
    }

    public function update($data, $img)
    {
        return $this->executeInsert("update escuelas set nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', id_usr='{$data["id_usr"]}', foto= if('{$img}'='',foto,'{$img}') where id_school={$data["id_school"]}");
    }

    public function deleteEscuela($id)
    {
        return $this->executeInsert("delete from escuelas where id_school='$id'");
    }

    function getEscuelaByUsuarios($id)
    {
        return  $this->executeQuery("select a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, b.id_usr from escuelas a inner join usuarios b on a.id_usr = b.id_usr order by a.id_usr where b.id_usr='{$id}' order by nombre");
    }

    function getEscuelaById($id)
    {
        return  $this->executeQuery("select a.id_school, a.nombre, a.direccion, a.email, a.latitud, a.longitud, b.id_usr from escuelas a inner join usuarios b on a.id_usr = b.id_usr where a.id_usr='{$id}' order by nombre");
    }

    public function getEscuelasYAlumnos()
    {
        $query = "
            SELECT 
                'escuela' AS tipo,
                e.id_school AS id,
                e.nombre AS nombre,
                e.direccion AS direccion,
                e.latitud AS latitud,
                e.longitud AS longitud,
                NULL AS id_alumno,
                NULL AS nombre_escuela
            FROM escuelas e
            UNION ALL
            SELECT 
                'alumno' AS tipo,
                a.id_school AS id,
                a.nombre_completo AS nombre,
                NULL AS direccion,
                a.latitud AS latitud,
                a.longitud AS longitud,
                a.id_alumno AS id_alumno,
                e.nombre AS nombre_escuela
            FROM alumnos a
            INNER JOIN escuelas e ON a.id_school = e.id_school
        ";
        return $this->executeQuery($query);
    }
}
