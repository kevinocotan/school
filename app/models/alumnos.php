<?php
include_once "app/models/db.class.php";

class Alumnos extends BaseDeDatos
{
    public function __construct()
    {
        $this->conectar();
    }

    public function getAll()
    {
        return $this->executeQuery("SELECT 
                                        a.id_alumno, 
                                        a.nombre_completo, 
                                        a.direccion, 
                                        a.telefono, 
                                        a.email, 
                                        a.foto, 
                                        a.genero, 
                                        a.latitud, 
                                        a.longitud, 
                                        a.id_usr, 
                                        b.nombre_grado, 
                                        c.nombre_seccion, 
                                        d.nombre AS nombre_escuela,
                                        u.nombres, 
                                        u.apellidos, 
                                        u.usuario, 
                                        u.tipo AS tipo_usuario, 
                                        u.foto AS foto_usuario
                                    FROM alumnos a 
                                    INNER JOIN grados b ON a.id_grado = b.id_grado 
                                    INNER JOIN secciones c ON a.id_seccion = c.id_seccion 
                                    INNER JOIN escuelas d ON a.id_school = d.id_school
                                    INNER JOIN usuarios u ON a.id_usr = u.id_usr
                                    ORDER BY a.id_alumno;");
    }


    public function getAlumnoByName($nombre)
    {
        return $this->executeQuery("SELECT id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school, id_usr 
            FROM alumnos 
            WHERE nombre_completo='{$nombre}'");
    }

    public function save($data, $img)
    {
        return $this->executeInsert("INSERT INTO alumnos SET 
            nombre_completo='{$data["nombre_completo"]}', 
            direccion='{$data["direccion"]}', 
            telefono='{$data["telefono"]}', 
            email='{$data["email"]}', 
            foto='{$img}', 
            genero='{$data["genero"]}', 
            latitud='{$data["latitud"]}', 
            longitud='{$data["longitud"]}', 
            id_grado='{$data["id_grado"]}', 
            id_seccion='{$data["id_seccion"]}', 
            id_school='{$data["id_school"]}', 
            id_usr='{$data["id_usr"]}'");
    }

    public function getOneAlumno($id)
    {
        return $this->executeQuery("SELECT id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school, id_usr 
            FROM alumnos 
            WHERE id_alumno='{$id}'");
    }

    public function update($data, $img)
    {
        return $this->executeInsert("UPDATE alumnos SET 
            nombre_completo='{$data["nombre_completo"]}', 
            direccion='{$data["direccion"]}', 
            telefono='{$data["telefono"]}', 
            email='{$data["email"]}', 
            foto='{$img}', 
            genero='{$data["genero"]}', 
            latitud='{$data["latitud"]}', 
            longitud='{$data["longitud"]}', 
            id_grado='{$data["id_grado"]}', 
            id_seccion='{$data["id_seccion"]}', 
            id_school='{$data["id_school"]}', 
            id_usr='{$data["id_usr"]}' 
            WHERE id_alumno={$data["id_alumno"]}");
    }

    public function deleteAlumno($id)
    {
        return $this->executeInsert("DELETE FROM alumnos WHERE id_alumno='$id'");
    }

    public function getAlumnosReporte($data)
    {
        $condicion = "";

        // Filtrar por id_grado si se proporciona
        if (isset($data["id_grado"]) && $data["id_grado"] != "0") {
            $condicion .= "AND alumnos.id_grado='{$data["id_grado"]}' ";
        }

        // Filtrar por id_seccion si se proporciona
        if (isset($data["id_seccion"]) && $data["id_seccion"] != "0") {
            $condicion .= "AND alumnos.id_seccion='{$data["id_seccion"]}' ";
        }

        // Filtrar por id_school si se proporciona
        if (isset($data["id_school"]) && $data["id_school"] != "0") {
            $condicion .= "AND alumnos.id_school='{$data["id_school"]}' ";
        }

        // Filtrar por id_alumno si se proporciona
        if (isset($data["id_alumno"]) && $data["id_alumno"] != "0") {
            $condicion .= "AND alumnos.id_alumno='{$data["id_alumno"]}' ";
        }

        $query = "SELECT alumnos.*, grados.nombre_grado AS grado, 
            secciones.nombre_seccion AS seccion, escuelas.nombre AS escuela 
            FROM alumnos
            INNER JOIN grados ON alumnos.id_grado = grados.id_grado
            INNER JOIN secciones ON alumnos.id_seccion = secciones.id_seccion
            INNER JOIN escuelas ON alumnos.id_school = escuelas.id_school
            WHERE 1=1 $condicion 
            ORDER BY alumnos.nombre_completo";

        error_log($query); // Depuración de la consulta SQL
        return $this->executeQuery($query);
    }

    public function getAlumnosByEscuela($id_school)
    {
        return $this->executeQuery("SELECT alumnos.*, grados.nombre_grado AS grado, 
            secciones.nombre_seccion AS seccion 
            FROM alumnos
            INNER JOIN grados ON alumnos.id_grado = grados.id_grado
            INNER JOIN secciones ON alumnos.id_seccion = secciones.id_seccion
            WHERE alumnos.id_school='{$id_school}' 
            ORDER BY alumnos.nombre_completo");
    }

    // app/models/alumnos.php

    public function getAlumnoActual($id_usr)
    {
        $query = "SELECT a.id_alumno, a.nombre_completo, a.direccion, a.telefono, a.email, a.foto, 
              a.genero, a.latitud, a.longitud, a.id_usr, b.nombre_grado, c.nombre_seccion, 
              d.nombre AS nombre_escuela, u.nombres, u.apellidos, u.usuario, u.tipo AS tipo_usuario, 
              u.foto AS foto_usuario 
              FROM alumnos a 
              INNER JOIN grados b ON a.id_grado = b.id_grado 
              INNER JOIN secciones c ON a.id_seccion = c.id_seccion 
              INNER JOIN escuelas d ON a.id_school = d.id_school 
              INNER JOIN usuarios u ON a.id_usr = u.id_usr 
              WHERE a.id_usr = '{$id_usr}' 
              LIMIT 1";

        return $this->executeQuery($query);
    }
}
