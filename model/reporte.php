<?php
ob_start();
require_once('vendor/autoload.php'); // Cambiar a la ruta correcta para cargar Dompdf
require_once('model/conexion.php');
use Dompdf\Dompdf;
use Dompdf\Options;
date_default_timezone_set('America/Bogota');

class reporte {
    private $conex;

    public function conectar(){
        $this->conex = new Conexion("sistema");
        $this->conex = $this->conex->Conex();
    }

    function equipos($datos){
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Equipos</title>
            <style>
                body { font-family: Arial, sans-serif; }
                h1 { color: #2c3e50; text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .logo { text-align: center; margin-bottom: 20px; }
                .info { margin-bottom: 30px; }
            </style>
        </head>
        <body>
            <div class="logo">
                <img src="img/OFITIC.jpg" style="width:150px;">
            </div>
            
            <h1>Reporte de Equipos</h1>
            
            <div class="info">
                <p><strong>Fecha:</strong> '.date('d/m/Y').'</p>
                <p><strong>Total de equipos:</strong> '.count($datos).'</p>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Serial</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Nro. Bien</th>
                        <th>Dependencia</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($datos as $index => $equipo) {
            $html .= '
                    <tr>
                        <td>'.($index + 1).'</td>
                        <td>'.$equipo['serial'].'</td>
                        <td>'.$equipo['tipo'].'</td>
                        <td>'.$equipo['marca'].'</td>
                        <td>'.($equipo['nro_bien'] ? $equipo['nro_bien'] : 'No asignado').'</td>
                        <td>'.$equipo['dependencia'].'</td>
                    </tr>';
        }

        $html .= '
                </tbody>
            </table>
            
            <div style="margin-top: 50px; text-align: right;">
                <p>_________________________</p>
                <p>Firma del responsable</p>
            </div>
        </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Reporte_Equipos_'.date('d_m_Y').'.pdf', ['Attachment' => false]);
    }
}
?>