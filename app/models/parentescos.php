<?php
include_once "app/models/db.class.php";

class Parentescos extends BaseDeDatos
{

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll()
    {
        return $this->executeQuery("SELECT a.id_padre_alumno, a.parentesco, date_format(a.fecha,'%d-%M-%Y') as fecha, b.nombre_completo, c.nombre AS nombre_padre FROM padresalumnos a INNER JOIN alumnos b ON a.id_alumno = b.id_alumno INNER JOIN padres c ON a.id_padre = c.id_padre ORDER BY a.id_padre_alumno;");
    }
    public function getParentescoByName($nombre)
    {
        return $this->executeQuery("SELECT id_padre_alumno, parentesco, fecha, id_alumno, id_padre FROM padresalumnos WHERE parentesco='{$nombre}'");
    }

    public function save($data)
    {
        return $this->executeInsert("INSERT INTO padresalumnos SET parentesco='{$data["parentesco"]}', fecha='{$data["fecha"]}', id_padre='{$data["id_padre"]}', id_alumno='{$data["id_alumno"]}'");
    }

    public function getOneParentesco($id)
    {
        return $this->executeQuery("SELECT id_padre_alumno, parentesco,fecha, id_alumno, id_padre FROM padresalumnos WHERE id_padre_alumno='{$id}'");
    }

    public function update($data)
    {
        return $this->executeInsert("UPDATE padresalumnos SET parentesco='{$data["parentesco"]}', fecha='{$data["fecha"]}', id_alumno='{$data["id_alumno"]}', id_padre='{$data["id_padre"]}' where id_padre_alumno='{$data["id_padre_alumno"]}'");
    }

    public function deleteParentesco($id)
    {
        return $this->executeInsert("DELETE FROM padresalumnos WHERE id_padre_alumno='$id'");
    }

    public function getPadrealumnoReporte($data)
    {
        $condicion = "";
        if (isset($data["id_padre_alumno"])) {
            if ($data["id_padre_alumno"] != "0") {
                $condicion .= "and fecha='{$data["id_padre_alumno"]}'";
            }
        }
        if (isset($data["mes"])) {
            $condicion .= "and month(fecha)='{$data["mes"]}' and year(fecha)='{$data["anio"]}'";
        }
        if ($data["id_alumno"] != "0") {
            $condicion .= "and a.id_alumno='{$data["id_alumno"]}'";
        }
        if ($data["id_padre"] != "0") {
            $condicion .= "and a.id_padre='{$data["id_padre"]}'";
        }

        return $this->executeQuery("SELECT a.id_padre_alumno, a.fecha, a.parentesco, b.nombre_completo, c.nombre
        FROM padresalumnos a
        INNER JOIN alumnos b ON a.id_alumno = b.id_alumno
        INNER JOIN padres c ON a.id_padre = c.id_padre
        WHERE 1=1 $condicion
        ORDER BY a.fecha");
    }

    public function getFechasPorPadrealumnos()
    {
        return $this->executeQuery("select fecha as id_padre_alumno, date_format(fecha,'%d-%M-%Y') AS fecha FROM padresalumnos GROUP BY fecha ORDER BY fecha");
    }
}
