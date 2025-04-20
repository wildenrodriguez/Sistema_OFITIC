<?php
ob_start();
require_once('assets/libreria/dompdf/src/Autoloader.php'); // Cambiar a la ruta correcta
Dompdf\Autoloader::register(); // Registrar el autoloader
require_once('model/conexion.php');
use Dompdf\Dompdf;
use Dompdf\Options;
date_default_timezone_set('America/Bogota');

class reporte {
    private $conex;

    public function conectar(){
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
    }

    function mis_servicios($datos){
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = '<html><body>';
        foreach ($datos as $key => $value) {
            $datos_cabecera = $value[0];
            $datos_tabla = $value[1];
            $html .= '<h1>Reporte de ' . $datos_cabecera["tipo_s"] . '</h1>';
            $html .= '<img src="img/OFITIC.jpg" style="width:150px;"><br>';
            $html .= '<p>Fecha: ' . date('d-m-Y', strtotime($datos_cabecera["fecha"])) . '</p>';
            $html .= '<p>Solicitante: ' . $datos_cabecera["solicitante"] . '</p>';
            $html .= '<p>Motivo: ' . $datos_cabecera["motivo"] . '</p>';
            $html .= '<hr>';
        }
        $html .= '</body></html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('Letter', 'portrait');
        $dompdf->render();
        $dompdf->stream('Resumen_Pedido_' . date('d_m_y') . '.pdf', ['Attachment' => false]);
    }
}
?>