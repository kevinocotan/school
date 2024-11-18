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
        $query = "SELECT a.id_padre_alumno, a.parentesco, b.nombre_completo, c.nombre AS nombre_padre
              FROM padresalumnos a
              INNER JOIN alumnos b ON a.id_alumno = b.id_alumno
              INNER JOIN padres c ON a.id_padre = c.id_padre
              ORDER BY a.id_padre_alumno;";

        return $this->executeQuery($query);
    }


    public function getParentescoByName($nombre)
    {
        return $this->executeQuery("SELECT id_padre_alumno, parentesco, id_alumno, id_padre FROM padresalumnos WHERE parentesco='{$nombre}'");
    }

    public function save($data)
    {
        return $this->executeInsert("INSERT INTO padresalumnos SET parentesco='{$data["parentesco"]}', id_padre='{$data["id_padre"]}', id_alumno='{$data["id_alumno"]}'");
    }

    public function getOneParentesco($id)
    {
        return $this->executeQuery("SELECT id_padre_alumno, parentesco, id_alumno, id_padre FROM padresalumnos WHERE id_padre_alumno='{$id}'");
    }

    public function update($data)
    {
        return $this->executeInsert("UPDATE padresalumnos SET parentesco='{$data["parentesco"]}', id_alumno='{$data["id_alumno"]}', id_padre='{$data["id_padre"]}' where id_padre_alumno='{$data["id_padre_alumno"]}'");
    }

    public function deleteParentesco($id)
    {
        return $this->executeInsert("DELETE FROM padresalumnos WHERE id_padre_alumno='$id'");
    }

    public function checkIfExist($id_alumno, $id_padre)
    {
        $query = "SELECT COUNT(*) as total FROM padresalumnos WHERE id_alumno = '{$id_alumno}' AND id_padre = '{$id_padre}'";
        $result = $this->executeQuery($query);
        return $result[0]['total'] > 0; // Si ya existe, retorna true
    }


    public function getResponsableReporte($data)
    {
        $condicion = "";

        // Filtrar por id_grado si se proporciona
        if (isset($data["id_padre"]) && $data["id_padre"] != "0") {
            $condicion .= "AND padresalumnos.id_padre='{$data["id_padre"]}' ";
        }

        // Filtrar por id_seccion si se proporciona
        if (isset($data["id_alumno"]) && $data["id_alumno"] != "0") {
            $condicion .= "AND padresalumnos.id_alumno='{$data["id_alumno"]}' ";
        }

        // Filtrar por id_padre_alumno si se proporciona
        if (isset($data["id_padre_alumno"]) && $data["id_padre_alumno"] != "0") {
            $condicion .= "AND padresalumnos.id_padre_alumno='{$data["id_padre_alumno"]}' ";
        }

        if (isset($data["id_padre_alumno"])) {
            if ($data["id_padre_alumno"] != "0") {
                $condicion .= "and fecha='{$data["id_padre_alumno"]}'";
            }
        }

        $query = "SELECT padresalumnos.*, padres.nombre AS padre, 
            alumnos.nombre_completo AS alumno
            FROM padresalumnos
            INNER JOIN padres ON padresalumnos.id_padre = padres.id_padre
            INNER JOIN alumnos ON padresalumnos.id_alumno = alumnos.id_alumno
            WHERE 1=1 $condicion 
            ORDER BY padresalumnos.id_padre_alumno";

        error_log($query); // Depuración de la consulta SQL
        return $this->executeQuery($query);
    }
}
