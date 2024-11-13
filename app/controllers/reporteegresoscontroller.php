<?php

include_once "app/models/egresos.php";
include_once "vendor/autoload.php";

class ReporteEgresosController extends Controller {
    private $egreso;
    public function __construct($parametro) {
        $this->egreso = new Egresos();
        parent::__construct("reporteegresos",$parametro,true);
    }

    public function getReporte(){
        $pageNumber = 1;
        $registros=$this->egreso->getEgresosReporte($_GET);
        $htmlHeader = '<div style="text-align: center;">
            <img src="/var/www/html/salondebelleza/public_html/images/logo.png"  style="width:500px; height: auto;">
            <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte De Egresos</h3>
            <h3 style="margin: 5px 0 0; font-size: 20px;">Listado general de Egresos</h3>
        </div>';
        $html="<table style='width: 100%; border-collapse: collapse;'>
        <thead>
            <tr style='background-color: #ddd;'>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Fecha</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Descripcion</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Monto</th>
            </tr>
        </thead>
        <tbody>";
        $total=0;
        foreach ($registros as $key => $value) {    
            $html.="<tr>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>".($key+1)."</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["fecha"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["descripcion"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>$ {$value["monto"]}</td>";
            $html.="</tr>";
            $total+=$value["monto"];
         
        }

        $html.="<tr>";
        $html.="<td style='border: 1px solid #999; text-align: center;' colspan='3'>Total</td>";
        $html.="<td style='border: 1px solid #999; text-align: center;'>$ $total</td>";
        $html.="</tr>";
        $html.="</tbody></table>";

        $htmlFooter = '<div style="text-align: center;">
        
        <p style="font-size: 12px;">Página {PAGENO} de {nb} </p>
        <p style="font-size: 12px;">© 2023 Iveth´s Beauty Salón Spa & Nails. Todos los derechos reservados.</p>
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
}