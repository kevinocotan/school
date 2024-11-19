<?php

include_once "app/models/escuelas.php";
include_once "app/models/alumnos.php";
include_once "app/models/parentescos.php";
include_once "vendor/autoload.php";

class ReportesController extends Controller
{
    private $escuela;
    private $alumno;
    private $parentesco;


    public function __construct($parametro)
    {
        $this->escuela = new Escuelas();
        $this->alumno = new Alumnos(); // Incluye la lógica de alumnos
        $this->parentesco = new Parentescos(); // Instancia el modelo

        parent::__construct("reportes", $parametro, true);
    }

    public function getReporteParentescoAlumno()
    {
        $idAlumno = $_GET['id_alumno'] ?? 0;

        // Obtener datos del modelo, ya sea todos o filtrados
        $registros = ($idAlumno == 0)
            ? $this->parentesco->getAll()
            : $this->parentesco->getParentescosByAlumno($idAlumno);

        // Encabezado del PDF
        $htmlHeader = '<div style="text-align: center;">
        <img src="public_html/images/school.jpg" style="width:100px; height: auto;">
        <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte de Parentescos</h3>
        <h3 style="margin: 5px 0 0; font-size: 20px;">Datos Generales de Parentescos</h3>
    </div>';

        // Generar tabla HTML con los registros
        $html = "<table style='width: 100%; border-collapse: collapse;'>
    <thead>
        <tr style='background-color: #ddd;'>
            ```php
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Responsable</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Parentesco</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Alumno</th>
        </tr>
    </thead>
    <tbody>";

        if (!empty($registros)) {
            foreach ($registros as $key => $value) {
                $html .= "<tr>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>" . ($key + 1) . "</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["responsable"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["parentesco"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["alumno"]}</td>";
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr><td colspan='4' style='text-align:center;'>No se encontraron resultados</td></tr>";
        }

        $html .= "</tbody></table>";

        // Pie del PDF
        $htmlFooter = '<div style="text-align: center;">
        <p style="font-size: 12px;">Página {PAGENO} de {nb}</p>
        <p style="font-size: 12px;">© 2024 MyControl School. Todos los derechos reservados.</p>
    </div>';

        // Configuración de MPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Letter',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 70,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P',
        ]);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function getReporteParentescoPadre()
    {
        $idPadre = $_GET['id_padre'] ?? 0;

        // Obtener datos del modelo, ya sea todos o filtrados
        $registros = ($idPadre == 0)
            ? $this->parentesco->getAll()
            : $this->parentesco->getParentescosByPadre($idPadre);

        // Encabezado del PDF
        $htmlHeader = '<div style="text-align: center;">
        <img src="public_html/images/school.jpg" style="width:100px; height: auto;">
        <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte de Parentescos</h3>
        <h3 style="margin: 5px 0 0; font-size: 20px;">Datos Generales de Parentescos</h3>
    </div>';

        // Generar tabla HTML con los registros
        $html = "<table style='width: 100%; border-collapse: collapse;'>
    <thead>
        <tr style='background-color: #ddd;'>
            ```php
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Responsable</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Parentesco</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Alumno</th>
        </tr>
    </thead>
    <tbody>";

        if (!empty($registros)) {
            foreach ($registros as $key => $value) {
                $html .= "<tr>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>" . ($key + 1) . "</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["responsable"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["parentesco"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["alumno"]}</td>";
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr><td colspan='4' style='text-align:center;'>No se encontraron resultados</td></tr>";
        }

        $html .= "</tbody></table>";

        // Pie del PDF
        $htmlFooter = '<div style="text-align: center;">
        <p style="font-size: 12px;">Página {PAGENO} de {nb}</p>
        <p style="font-size: 12px;">© 2024 MyControl School. Todos los derechos reservados.</p>
    </div>';

        // Configuración de MPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Letter',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 70,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P',
        ]);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function getReporteEscuela()
    {
        $pageNumber = 1;
        $registros = $this->escuela->getEscuelasReporte($_GET);
        $htmlHeader = '<div style="text-align: center;">
            <img src="public_html/images/school.jpg"  style="width:100px; height: auto;">
            <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte de Escuelas</h3>
            <h3 style="margin: 5px 0 0; font-size: 20px;">Datos Generales de Escuelas</h3>
        </div>';
        $html = "<table style='width: 100%; border-collapse: collapse;'>
        <thead>
            <tr style='background-color: #ddd;'>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Nombre</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Email</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Direccion</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($registros as $key => $value) {
            $html .= "<tr>";
            $html .= "<td style='border: 1px solid #999; text-align: center;'>" . ($key + 1) . "</td>";
            $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["nombre"]}</td>";
            $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["email"]}</td>";
            $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["direccion"]}</td>";
            $html .= "</tr>";
        }

        $html .= "<tr>";
        $html .= "</tr>";
        $html .= "</tbody></table>";

        $htmlFooter = '<div style="text-align: center;">
        
        <p style="font-size: 12px;">Página {PAGENO} de {nb} </p>
        <p style="font-size: 12px;">© 2024 MyControl School. Todos los derechos reservados.</p>
        </div>';

        $mpdfConfig = array(
            'mode' => 'utf-8',
            'format' => 'Letter',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 70,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P'
        );

        $mpdf = new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        $mpdf->AddPage();
        $pageNumber++;
    }

    public function getReporteAlumno()
    {
        $pageNumber = 1;
        $registros = $this->alumno->getAlumnosReporte($_GET);
        $htmlHeader = '<div style="text-align: center;">
        <img src="public_html/images/school.jpg" style="width:100px; height: auto;">
        <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte de Alumnos</h3>
        <h3 style="margin: 5px 0 0; font-size: 20px;">Datos Generales de Alumnos</h3>
    </div>';
        $html = "<table style='width: 100%; border-collapse: collapse;'>
    <thead>
        <tr style='background-color: #ddd;'>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Alumno</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Dirección</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Teléfono</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Genero</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Grado</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Sección</th>
            <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Escuela</th>
        </tr>
    </thead>
    <tbody>";

        if (!empty($registros)) {
            foreach ($registros as $key => $value) {
                $html .= "<tr>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>" . ($key + 1) . "</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["nombre_completo"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["direccion"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["telefono"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["genero"]}</td>";
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["grado"]}</td>"; // Cambiado
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["seccion"]}</td>"; // Cambiado
                $html .= "<td style='border: 1px solid #999; text-align: center;'>{$value["escuela"]}</td>"; // Cambiado
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr><td colspan='8' style='text-align:center;'>No se encontraron resultados</td></tr>";
        }

        $html .= "</tbody></table>";

        $htmlFooter = '<div style="text-align: center;">
            <p style="font-size: 12px;">Página {PAGENO} de {nb}</p>
            <p style="font-size: 12px;">© 2024 MyControl School. Todos los derechos reservados.</p>
        </div>';

        $mpdfConfig = array(
            'mode' => 'utf-8',
            'format' => 'Letter',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 70,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P'
        );

        $mpdf = new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
