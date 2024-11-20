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
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud FROM escuelas ORDER BY id_school;");
    }

    public function getEscuelaByName($nombre)
    {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud FROM escuelas WHERE nombre='{$nombre}'");
    }

    public function save($data, $img)
    {
        return $this->executeInsert("INSERT INTO escuelas SET nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', foto='{$img}'");
    }

    public function getOneEscuela($id)
    {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud, foto FROM escuelas WHERE id_school='{$id}'");
    }

    public function update($data, $img)
    {
        return $this->executeInsert("UPDATE escuelas SET nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', foto=IF('{$img}'='', foto, '{$img}') WHERE id_school={$data["id_school"]}");
    }

    public function deleteEscuela($id)
    {
        return $this->executeInsert("DELETE FROM escuelas WHERE id_school='$id'");
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
                e.foto AS imagen,  -- Agregar columna de imagen aquí
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
                NULL AS imagen,  -- Los alumnos no tienen imagen
                a.id_alumno AS id_alumno,
                e.nombre AS nombre_escuela
            FROM alumnos a
            INNER JOIN escuelas e ON a.id_school = e.id_school
        ";
        return $this->executeQuery($query);
    }


    public function getEscuelaActual($id_school)
    {
        $query = "SELECT id_school, nombre, direccion, email, foto, latitud, longitud 
              FROM escuelas 
              WHERE id_school = '{$id_school}' 
              LIMIT 1";

        return $this->executeQuery($query);
    }

    public function getEscuelasMapa($ids)
    {
        $id_school = $ids['id_escuela'];
        // Consulta corregida con INNER JOIN para obtener los datos de los alumnos
        $query = "SELECT 
                    e.foto AS foto_escuela,
                    e.latitud AS latitud_escuela,
                    e.longitud AS longitud_escuela,
                    e.nombre AS nombre_escuela,
                    a.nombre_completo AS nombre_alumno,
                    a.latitud AS latitud_alumno,
                    a.longitud AS longitud_alumno
                  FROM 
                    escuelas e 
                  LEFT JOIN alumnos a ON e.id_school = a.id_school 
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
}
