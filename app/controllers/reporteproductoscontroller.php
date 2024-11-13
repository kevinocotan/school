<?php

include_once "app/models/ingresos.php";
include_once "vendor/autoload.php";

class ReporteProductosController extends Controller {
    private $ingreso;
    public function __construct($parametro) {
        $this->ingreso = new Ingresos();
        parent::__construct("reporteproductos",$parametro,true);
    }

    public function getReporte(){
        $registros=$this->ingreso->getProductosReporte($_GET);
        $htmlHeader = '<div style="text-align: center;">
            <img src="/var/www/html/salondebelleza/public_html/images/logo.png"  style="width:600px; height: auto;">
            <h3 style="margin: 5px 0 0; font-size: 20px;">Reporte De Productos</h3>
            <h3 style="margin: 5px 0 0; font-size: 20px;">Listado General De Productos</h3>
        </div>';
       $html="<table style='width: 100%; border-collapse: collapse;'>
        <thead>
            <tr style='background-color: #ddd;'>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Código</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Fecha</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Método de Pago</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Empleado</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Producto</th>
                <th style='padding: 10px; border: 1px solid #999; text-align: center;'>Precio de Producto</th>
            </tr>
        </thead>
        <tbody>";
        $total=0;
        foreach ($registros as $key => $value) { 
            //$subtotal=$value["precio"]+$value["precios"];   
            $html.="<tr>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>".($key+1)."</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["fecha"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["metodopago"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["nombres"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>{$value["nombre"]}</td>";
            $html.="<td style='border: 1px solid #999; text-align: center;'>$ {$value["precio"]}</td>";
            $html.="</tr>";
            //$total+=$value["precios"];
            $total+=$value["precio"];
        }

        $html.="<tr>";
        $html.="<td style='border: 1px solid #999; text-align: center;' colspan='5'>Total</td>";
        $html.="<td style='border: 1px solid #999; text-align: center;'>$ $total</td>";
        $html.="</tr>";
        $html.="</tbody></table>";
       
        $htmlFooter = '<div style="text-align: center;">
        <p style="font-size: 12px;">© 2023 Iveth´s Beauty Salón Spa & Nails. Todos los derechos reservados.</p>
        </div>';

        $mpdfConfig=array(
            'mode'=>'utf-8',
            'format' => 'Letter',
            'default_font_size'=>0,
            'default_font'=>'',
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>80,
            'margin_header'=>10,
            'margin_footer'=>20,
            'orientation'=>'P'
        );

        $mpdf=new \Mpdf\Mpdf ($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML ($html);
        $mpdf->Output ();
    
    }
}