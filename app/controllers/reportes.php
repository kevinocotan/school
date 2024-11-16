<?php

include_once "app/models/alumnos.php";
include_once "vendor/autoload.php";

class ReportesController extends Controller {
    private $alumno;

    public function __construct($parametro) {
        $this->alumno = new Alumnos();
        parent::__construct("reportes", $parametro, true);
    }

    public function getReporte() {
        $registros = $this->alumno->getAlumnosReporte($_GET);
        
        $htmlHeader = "<h1>Reporte de Alumnos</h1>";
        $htmlHeader .= "<h3>Listado General de Alumnos</h3>";

        // Generar cuerpo del informe
        $html = "<table width='100%' border='1' cellspacing='0' cellpadding='5'><thead><tr>";
        $html .= "<th>#</th>";
        $html .= "<th>Nombre</th>";
        $html .= "<th>Dirección</th>";
        $html .= "<th>Teléfono</th>";
        $html .= "<th>Email</th>";
        $html .= "<th>Género</th>";
        $html .= "<th>Escuela</th>";
        $html .= "<th>Grado</th>";
        $html .= "<th>Sección</th>";
        $html .= "</tr></thead><tbody>";

        foreach ($registros as $key => $value) {
            $html .= "<tr>";
            $html .= "<td>" . ($key + 1) . "</td>";
            $html .= "<td>{$value["nombre_completo"]}</td>";
            $html .= "<td>{$value["direccion"]}</td>";
            $html .= "<td>{$value["telefono"]}</td>";
            $html .= "<td>{$value["email"]}</td>";
            $html .= "<td>{$value["genero"]}</td>";
            $html .= "<td>{$value["escuela"]}</td>";
            $html .= "<td>{$value["grado"]}</td>";
            $html .= "<td>{$value["seccion"]}</td>";
            $html .= "</tr>";
        }

        $html .= "</tbody></table>";

        // Configuración de mPDF
        $mpdfConfig = array(
            'mode' => 'utf-8',
            'format' => 'Letter',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 40,
            'margin_header' => 10,
            'margin_footer' => 20,
            'orientation' => 'P'
        );

        $mpdf = new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
