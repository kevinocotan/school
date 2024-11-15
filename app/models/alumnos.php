<?php
include_once "app/models/db.class.php";

class Alumnos extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("SELECT a.id_alumno, a.nombre_completo, a.direccion, a.telefono, a.email, a.foto, a.genero, a.latitud, a.longitud, b.nombre_grado, c.nombre_seccion, d.nombre AS nombre_escuela FROM alumnos a INNER JOIN grados b ON a.id_grado = b.id_grado INNER JOIN secciones c ON a.id_seccion = c.id_seccion INNER JOIN escuelas d ON a.id_school = d.id_school ORDER BY a.id_alumno;");
    }

    public function getAlumnoByName($nombre) {
        return $this->executeQuery("SELECT id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school FROM alumnos WHERE nombre_completo='{$nombre}'");
    }

    public function save($data, $img) {
        return $this->executeInsert("INSERT INTO alumnos SET nombre_completo='{$data["nombre_completo"]}', direccion='{$data["direccion"]}', telefono='{$data["telefono"]}', email='{$data["email"]}', foto='{$img}', genero='{$data["genero"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', id_grado='{$data["id_grado"]}', id_seccion='{$data["id_seccion"]}', id_school='{$data["id_school"]}'");
    }

    public function getOneAlumno($id) {
        return $this->executeQuery("SELECT id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school FROM alumnos WHERE id_alumno='{$id}'");
    }

    public function update($data, $img) {
        return $this->executeInsert("UPDATE alumnos SET nombre_completo='{$data["nombre_completo"]}', direccion='{$data["direccion"]}', telefono='{$data["telefono"]}', email='{$data["email"]}', foto='{$img}', genero='{$data["genero"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', id_grado='{$data["id_grado"]}', id_seccion='{$data["id_seccion"]}', id_school='{$data["id_school"]}' WHERE id_alumno={$data["id_alumno"]}");
    }

    public function deleteAlumno($id) {
        return $this->executeInsert("DELETE FROM alumnos WHERE id_alumno='$id'");
    }

}
?>