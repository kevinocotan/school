<?php

include_once "app/models/alumnos.php";
include_once "vendor/autoload.php";

class ReporteAlumnosController extends Controller {
    private $alumno;
    public function __construct($parametro) {
        $this->alumno = new Alumnos();
        parent::__construct("reportes",$parametro,true);
    }

    public function getAlumnos(){
        $registros=$this->alumno->getAlumnosReporte($_GET);
        // print_r($registros);
        $htmlHeader="<h1>Reporte de Alumnos</h1>";
        $htmlHeader.="<h3>Listado General de Alumnos</h3>";
        //Cuerpo del infome
        $html="<table width='100%' border='1'><thead><tr>";
        $html.="<th>Corr</th>";
        $html.="<th>Titulo</th>";
        $html.="<th>Descripcion</th>";
        $html.="<th>Categoría</th>";
        $html.="<th>Autor</th>";
        $html.="<th>Fecha de Publicacion</th>";
        $html.="<th>Precio</th>";
        $html.="</tr></thead><tbody>";
        $total=0;
        foreach ($registros as $key => $value) {
            $html.="<tr>";
            $html.="<td>".($key+1)."</td>";
            $html.="<td>{$value["titulo"]}</td>";
            $html.="<td>{$value["descripcion"]}</td>";
            $html.="<td>{$value["categoria"]}</td>";
            $html.="<td>{$value["autor"]}</td>";
            $html.="<td>{$value["fecha_pub"]}</td>";
            $html.="<td>{$value["precio"]}</td>";
            $html.="</tr>";
            $total+=$value["precio"];
        }
        $html.="<tr>";
        $html.="<th colspan='6'> Total </th>";
        $html.="<td> $total </td>";
        $html.="</tr>";
        $html.="</tbody></table>";
        //colspan cantidad de columnas
        //echo $html;
        $mpdfConfig=array(
            'mode'=>'utf-8',
            'format' => 'Letter',
            'default_font_size'=>0,
            'default_font'=>'',
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>40,
            'margin_header'=>10,
            'margin_footer'=>20,
            'orientation'=>'P'
        );

        $mpdf=new \Mpdf\Mpdf ($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->WriteHTML ($html);
        $mpdf->Output ();

    }
}