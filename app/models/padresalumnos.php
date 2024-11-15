<?php
include_once "app/models/db.class.php";

class PadresAlumnos extends BaseDeDatos
{

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll()
    {
        return $this->executeQuery("SELECT a.id_padre_alumno, a.parentesco, b.nombre_completo, c.nombre AS nombre_padre FROM padresalumnos a INNER JOIN alumnos b ON a.id_alumno = b.id_alumno INNER JOIN padres c ON a.id_padre = c.id_padre ORDER BY a.id_padre_alumno;");
    }
    public function getPadresAlumnosByName($nombre)
    {
        return $this->executeQuery("SELECT id_padre_alumno, parentesco, id_alumno, id_padre FROM padresalumnos WHERE parentesco='{$nombre}'");
    }

    public function save($data)
    {
        return $this->executeInsert("INSERT INTO padresalumnos SET parentesco='{$data["parentesco"]}', id_padre='{$data["id_padre"]}', id_alumno='{$data["id_alumno"]}'");
    }

    public function getOnePadresAlumnos($id)
    {
        return $this->executeQuery("SELECT id_padre_alumno, parentesco, id_alumno, id_padre FROM padresalumnos WHERE id_padre_alumno='{$id}'");
    }

    public function update($data)
    {
        return $this->executeInsert("UPDATE padresalumnos SET parentesco='{$data["parentesco"]}', id_alumno='{$data["id_alumno"]}', id_padre='{$data["id_padre"]}' where id_padre_alumno='{$data["id_padre_alumno"]}'");
    }

    public function deletePadresAlumnos($id)
    {
        return $this->executeInsert("DELETE FROM padresalumnos WHERE id_padre_alumno='$id'");
    }

}
