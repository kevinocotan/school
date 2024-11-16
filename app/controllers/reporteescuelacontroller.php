<?php

include_once "app/models/escuelas.php";
include_once "vendor/autoload.php";

class ReporteEscuelaController extends Controller {
    private $reporte;
    public function __construct($parametro) {
        $this->reporte = new Escuelas();
        parent::__construct("reporteescuela",$parametro,true);
    }

    public function getReporte(){
        $pageNumber = 1;
        $registros=$this->reporte->getEscuelaReporte($_GET);
        $htmlHeader = '<div style="text-align: center;">
            <img src="public_html/images/school.jpg"  style="width:100px; height: auto;">
            <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte De Escuelas</h3>
            <h3 style="margin: 5px 0 0; font-size: 20px;">Listado general de Escuelas</h3>
        </div>';
        $html="<table style='width: 100%; border-collapse: collapse;'>
        <thead>
            <tr style='background-color: #ddd;'>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Nombre</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Email</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Direccion</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Fecha</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($registros as $key => $value) {    
            $html.="<tr>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>".($key+1)."</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["nombre"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["email"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["direccion"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["fecha"]}</td>";
            $html.="</tr>";
         
        }

        $html.="<tr>";
        $html.="</tr>";
        $html.="</tbody></table>";

        $htmlFooter = '<div style="text-align: center;">
        
        <p style="font-size: 12px;">Página {PAGENO} de {nb} </p>
        <p style="font-size: 12px;">© 2024 Sistema School. Todos los derechos reservados.</p>
        </div>';

        $mpdfConfig=array(
            'mode'=>'utf-8',
            'format' => 'Letter',
            'default_font_size'=>0,
            'default_font'=>'',
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>70,
            'margin_header'=>10,
            'margin_footer'=>10,
            'orientation'=>'P'
        );

        $mpdf=new \Mpdf\Mpdf ($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML ($html);
        $mpdf->Output ();
        $mpdf->AddPage();
        $pageNumber++;

    }
    public function getFechasPorEscuelas(){
        $records=$this->reporte->getFechasPorEscuelas();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }
}