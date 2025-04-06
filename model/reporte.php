<?php
ob_start();
require_once('tcpdf/tcpdf.php');
require_once('model/conexion.php');
date_default_timezone_set('America/Bogota');

class reporte extends TCPDF{
    private $conex;

    public function conectar(){
        $this->conex = new Conexion();
        $this->conex = $this->conex->Conex();
    }

    function mis_servicios($datos){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

        // Set margins, header/footer options
        $pdf->SetMargins(20, 35, 25);
        $pdf->SetHeaderMargin(20);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(true);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Set document information
        $pdf->SetCreator('OFITIC');
        $pdf->SetAuthor('OFITIC');
        $pdf->SetTitle($_SESSION['user']['nombre'] . " reporte " . date('d-m-Y'));

        foreach ($datos as $key => $value) {
                $datos_cabecera = $value[0];
                $datos_tabla = $value[1];
            if ($key == "0" or $key == "2") {
                $pdf->AddPage();
                $pdf->Image('img/OFITIC.jpg', 20, 35, 50, 15, 'JPG',"C");
            }
            else{
                $pdf->Image('img/OFITIC.jpg', 20, 35, 50, 15, 'JPG',"C");
            }
            switch ($datos_cabecera["tipo_s"]) {
                case 'Electrónica':
                        $this->electronica($pdf,$datos_cabecera,$datos_tabla);
                    break;
                case 'Redes':
                        $this->redes($pdf,$datos_cabecera,$datos_tabla);
                    break;
                case 'Soporte Técnico':
                        $this->soporte_tecnico($pdf,$datos_cabecera,$datos_tabla);
                    break;
                case 'Telefonía':
                        $this->telefonia($pdf,$datos_cabecera,$datos_tabla);
                    break;
            }

            $pdf->Line(0, $pdf->GetPageHeight() / 2, $pdf->GetPageWidth(), $pdf->GetPageHeight() / 2, array('dash' => ''));

            $pdf->SetXY($pdf->GetPageWidth() / 2, $pdf->GetPageHeight() / 2 + 10);
        }

        ob_clean(); //limpiar la memoria
        // Output the PDF
        $pdf->Output('Resumen_Pedido_' . date('d_m_y') . '.pdf', 'I');
    }

    private function telefonia($pdf,$datos_cabecera,$datos_tabla){
        // Style the report title

        $pdf->SetTextColor(52, 104, 214);  // #3468d8
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Hoja de Telefonía', 0, 1, 'R');
        $pdf->Ln(10);

        // Style the table
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(204, 204, 204);  // #ccc
        $pdf->SetLineWidth(1);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $pdf->Cell(50, 6, "Fecha: ".date('m-d-Y', strtotime($datos_cabecera["fecha"])), 1, 0, 'C', 1);
        $pdf->Cell(25, 6, 'N°: '.$datos_cabecera["nro"], 1, 0, 'C', 1);
        $pdf->Cell(90, 6, 'Solicitante: '.$datos_cabecera["solicitante"], 1, 1, 'C', 1);
        $pdf->Cell(40, 6, 'TLF: '.$datos_cabecera["telefono"], 1, 0, 'C', 1);
        $pdf->Cell(125, 6, "Unidad/Dependencia: ".$datos_cabecera["unidad"]."/".$datos_cabecera["dependencia"], 1, 1, 'C', 1);
        $pdf->Cell("61", 6, 'Equipo/Marca/Serial/N° Bien', 1, 0, 'C', 1);
        $pdf->Cell("104", 6, $datos_cabecera["tipo"]."/".$datos_cabecera["marca"]."/".$datos_cabecera["serial"]."/".$datos_cabecera["nro_bien"], 1, 1, 'C', 1);
        $pdf->Cell("165", 6, 'Motivo: '.$datos_cabecera["motivo"], 1, 1, 'C', 1);
        $pdf->Cell("50", 18, "Información", 1, 0, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        
        $string = "";
        foreach ($datos_tabla as $compo => $dato) {
            $componente = $compo;

            $componente = str_replace("_", " ", $componente);

            if ($dato=="") {
                $string = $string.$componente.", ";
            } else {
                $string = $string.$componente." ".$dato.", ";
            }
        }
    
        $pdf->MultiCell("115", 18, $string , 1, 1, 'C', 1);

        $pdf->Cell("165", 6, "Observación: ".$datos_cabecera["observacion"], 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);

        if ($datos_cabecera["resultado"]=="Sin funcionar") {
            $pdf->SetFillColor(184, 68, 62);  // #f8f8f8
        } else {
            $pdf->SetFillColor(54, 168, 88);  // #f8f8f8
        }
    
        $pdf->Cell("60", 6, "Resultado: ".$datos_cabecera["resultado"], 1, 0, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8

        $pdf->Cell("105", 6, "Técnico: ".$datos_cabecera["tecnico"], 1, 1, 'C', 1);
    }

    private function redes($pdf,$datos_cabecera,$datos_tabla){
        // Style the report title

        $pdf->SetTextColor(52, 104, 214);  // #3468d8
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Hoja de Redes', 0, 1, 'R');
        $pdf->Ln(10);

        // Style the table
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(204, 204, 204);  // #ccc
        $pdf->SetLineWidth(1);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $pdf->Cell(50, 6, "Fecha: ".date('m-d-Y', strtotime($datos_cabecera["fecha"])), 1, 0, 'C', 1);
        $pdf->Cell(25, 6, 'N°: '.$datos_cabecera["nro"], 1, 0, 'C', 1);
        $pdf->Cell(90, 6, 'Solicitante: '.$datos_cabecera["solicitante"], 1, 1, 'C', 1);
        $pdf->Cell(40, 6, 'TLF: '.$datos_cabecera["telefono"], 1, 0, 'C', 1);
        $pdf->Cell(125, 6, "Unidad/Dependencia: ".$datos_cabecera["unidad"]."/".$datos_cabecera["dependencia"], 1, 1, 'C', 1);
        $pdf->Cell("61", 6, 'Equipo/Marca/Serial/N° Bien', 1, 0, 'C', 1);
        $pdf->Cell("104", 6, $datos_cabecera["tipo"]."/".$datos_cabecera["marca"]."/".$datos_cabecera["serial"]."/".$datos_cabecera["nro_bien"], 1, 1, 'C', 1);
        $pdf->Cell("165", 6, 'Motivo: '.$datos_cabecera["motivo"], 1, 1, 'C', 1);
        $pdf->Cell("50", 18, "Información", 1, 0, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        
        $string = "";
        foreach ($datos_tabla as $compo => $dato) {
            $componente = $compo;

            $componente = str_replace("_", " ", $componente);

            if ($dato=="") {
                $string = $string.$componente.", ";
            } else {
                $string = $string.$componente." ".$dato.", ";
            }
        }
    
        $pdf->MultiCell("115", 18, $string , 1, 1, 'C', 1);

        $pdf->Cell("165", 6, "Observación: ".$datos_cabecera["observacion"], 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);

        if ($datos_cabecera["resultado"]=="Sin funcionar") {
            $pdf->SetFillColor(184, 68, 62);  // #f8f8f8
        } else {
            $pdf->SetFillColor(54, 168, 88);  // #f8f8f8
        }
    
        $pdf->Cell("60", 6, "Resultado: ".$datos_cabecera["resultado"], 1, 0, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8

        $pdf->Cell("105", 6, "Técnico: ".$datos_cabecera["tecnico"], 1, 1, 'C', 1);
    }

    
    private function soporte_tecnico($pdf,$datos_cabecera,$datos_tabla){
        // Style the report title

        $pdf->SetTextColor(52, 104, 214);  // #3468d8
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Hoja de Soporte Técnico', 0, 1, 'R');
        $pdf->Ln(10);

        // Style the table
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(204, 204, 204);  // #ccc
        $pdf->SetLineWidth(1);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $pdf->Cell(50, 6, "Fecha: ".date('m-d-Y', strtotime($datos_cabecera["fecha"])), 1, 0, 'C', 1);
        $pdf->Cell(25, 6, 'N°: '.$datos_cabecera["nro"], 1, 0, 'C', 1);
        $pdf->Cell(90, 6, 'Solicitante: '.$datos_cabecera["solicitante"], 1, 1, 'C', 1);
        $pdf->Cell(40, 6, 'TLF: '.$datos_cabecera["telefono"], 1, 0, 'C', 1);
        $pdf->Cell(125, 6, "Unidad/Dependencia: ".$datos_cabecera["unidad"]."/".$datos_cabecera["dependencia"], 1, 1, 'C', 1);
        $pdf->Cell("61", 6, 'Equipo/Marca/Serial/N° Bien', 1, 0, 'C', 1);
        $pdf->Cell("104", 6, $datos_cabecera["tipo"]."/".$datos_cabecera["marca"]."/".$datos_cabecera["serial"]."/".$datos_cabecera["nro_bien"], 1, 1, 'C', 1);
        $pdf->Cell("165", 6, 'Motivo: '.$datos_cabecera["motivo"], 1, 1, 'C', 1);
        $pdf->Cell("50", 18, "Componentes Internos", 1, 0, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        
        $string = "";
        foreach ($datos_tabla as $compo => $dato) {
            $componente = $compo;

            if (strpos($componente, "componente_") !== false) {

                $componente = str_replace("componente_", "", $componente);

                $componente = str_replace("_", " ", $componente);

                if ($dato=="") {
                    $string = $string.$componente.", ";
                } else {
                    $string = $string.$componente." ".$dato.", ";
                }
            }
        }
    
        $pdf->MultiCell("115", 18, $string , 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $pdf->Cell("50", 18, "Servicio Prestado", 1, 0, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        
        $string = "";
        foreach ($datos_tabla as $compo => $dato) {
            $componente = $compo;

            if (strpos($componente, "servicio_") !== false) {

                $componente = str_replace("servicio_", "", $componente);

                $componente = str_replace("_", " ", $componente);

                if ($dato=="") {
                    $string = $string.$componente.", ";
                } else {
                    $string = $string.$componente." ".$dato.", ";
                }
            }
        }
        $pdf->MultiCell("115", 18, $string , 1, 1, 'C', 1);

        $pdf->Cell("165", 6, "Observación: ".$datos_cabecera["observacion"], 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);

        if ($datos_cabecera["resultado"]=="Sin funcionar") {
            $pdf->SetFillColor(184, 68, 62);  // #f8f8f8
        } else {
            $pdf->SetFillColor(54, 168, 88);  // #f8f8f8
        }
    
        $pdf->Cell("60", 6, "Resultado: ".$datos_cabecera["resultado"], 1, 0, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8

        $pdf->Cell("105", 6, "Técnico: ".$datos_cabecera["tecnico"], 1, 1, 'C', 1);
    }

    private function electronica($pdf,$datos_cabecera,$datos_tabla){
        // Style the report title

        $pdf->SetTextColor(52, 104, 214);  // #3468d8
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Hoja de Electrónica', 0, 1, 'R');
        $pdf->Ln(10);

        // Style the table
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(204, 204, 204);  // #ccc
        $pdf->SetLineWidth(1);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $pdf->Cell(50, 6, "Fecha: ".date('m-d-Y', strtotime($datos_cabecera["fecha"])), 1, 0, 'C', 1);
        $pdf->Cell(25, 6, 'N°: '.$datos_cabecera["nro"], 1, 0, 'C', 1);
        $pdf->Cell(90, 6, 'Solicitante: '.$datos_cabecera["solicitante"], 1, 1, 'C', 1);
        $pdf->Cell(40, 6, 'TLF: '.$datos_cabecera["telefono"], 1, 0, 'C', 1);
        $pdf->Cell(125, 6, "Unidad/Dependencia: ".$datos_cabecera["unidad"]."/".$datos_cabecera["dependencia"], 1, 1, 'C', 1);
        $pdf->Cell("61", 6, 'Equipo/Marca/Serial/N° Bien', 1, 0, 'C', 1);
        $pdf->Cell("104", 6, $datos_cabecera["tipo"]."/".$datos_cabecera["marca"]."/".$datos_cabecera["serial"]."/".$datos_cabecera["nro_bien"], 1, 1, 'C', 1);
        $pdf->Cell("165", 6, 'Motivo: '.$datos_cabecera["motivo"], 1, 1, 'C', 1);
        $pdf->Cell("50", 18, "Cambio de componente", 1, 0, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        
        $string = "";
        foreach ($datos_tabla as $compo => $dato) {
            $componente = $compo;

            if (strpos($componente, "Cambio_") !== false) {

                $componente = str_replace("Cambio_", "", $componente);

                $componente = str_replace("_", " ", $componente);

                if ($dato=="") {
                    $string = $string.$componente.", ";
                } else {
                    $string = $string.$componente." ".$dato.", ";
                }
            }
        }
    
        $pdf->MultiCell("115", 18, $string , 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $pdf->Cell("50", 18, "Servicio Prestado", 1, 0, 'C', 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        
        $string = "";
        foreach ($datos_tabla as $compo => $dato) {
            $componente = $compo;

            if (strpos($componente, "servicio_") !== false) {

                $componente = str_replace("servicio_", "", $componente);

                $componente = str_replace("_", " ", $componente);

                if ($dato=="") {
                    $string = $string.$componente.", ";
                } else {
                    $string = $string.$componente." ".$dato.", ";
                }
            }
        }
        $pdf->MultiCell("115", 18, $string , 1, 1, 'C', 1);

        $pdf->Cell("165", 6, "Observación: ".$datos_cabecera["observacion"], 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);

        if ($datos_cabecera["resultado"]=="Sin funcionar") {
            $pdf->SetFillColor(184, 68, 62);  // #f8f8f8
        } else {
            $pdf->SetFillColor(54, 168, 88);  // #f8f8f8
        }
    
        $pdf->Cell("60", 6, "Resultado: ".$datos_cabecera["resultado"], 1, 0, 'C', 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8

        $pdf->Cell("105", 6, "Técnico: ".$datos_cabecera["tecnico"], 1, 1, 'C', 1);
    }

    function hoja_servicio($datos_cabecera,$datos_tabla) {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

        // Set margins, header/footer options
        $pdf->SetMargins(20, 35, 25);
        $pdf->SetHeaderMargin(20);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(true);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Set document information
        $pdf->SetCreator('OFITIC');
        $pdf->SetAuthor('OFITIC');
        $pdf->SetTitle($_SESSION['user']['nombre'] . " reporte " . date('d-m-Y'));

        // Add a page
        $pdf->AddPage();
        $pdf->Image('img/OFITIC.jpg', 20, 35, 50, 15, 'JPG',"C");
        switch ($datos_cabecera["tipo_s"]) {
            case 'Electrónica':
                    $this->electronica($pdf,$datos_cabecera,$datos_tabla);
                break;
            case 'Redes':
                    $this->redes($pdf,$datos_cabecera,$datos_tabla);
                break;
            case 'Soporte Técnico':
                    $this->soporte_tecnico($pdf,$datos_cabecera,$datos_tabla);
                break;
            case 'Telefonía':
                    $this->telefonia($pdf,$datos_cabecera,$datos_tabla);
                break;
        }

        $pdf->Line(0, $pdf->GetPageHeight() / 2, $pdf->GetPageWidth(), $pdf->GetPageHeight() / 2, array('dash' => ''));

        $pdf->SetXY($pdf->GetPageWidth() / 2, $pdf->GetPageHeight() / 2 + 10);
        $pdf->Image('img/OFITIC.jpg', 20, 160, 50, 15, 'JPG',"C");
        $pdf->SetLineStyle('solid');
        switch ($datos_cabecera["tipo_s"]) {
            case 'Electrónica':
                    $this->electronica($pdf,$datos_cabecera,$datos_tabla);
                break;
            case 'Redes':
                    $this->redes($pdf,$datos_cabecera,$datos_tabla);
                break;
            case 'Soporte Técnico':
                    $this->soporte_tecnico($pdf,$datos_cabecera,$datos_tabla);
                break;
            case 'Telefonía':
                    $this->telefonia($pdf,$datos_cabecera,$datos_tabla);
                break;
        }

        ob_clean(); //limpiar la memoria
        // Output the PDF
        $pdf->Output('Resumen_Pedido_' . date('d_m_y') . '.pdf', 'I');
    }

    public function solicitudes($datos){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

        // Set margins, header/footer options
        $pdf->SetMargins(20, 35, 25);
        $pdf->SetHeaderMargin(20);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(true);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Set document information
        $pdf->SetCreator('OFITIC');
        $pdf->SetAuthor('OFITIC');
        $pdf->SetTitle($_SESSION['user']['nombre'] . " reporte " . date('d-m-Y'));

        // Add a page
        $pdf->AddPage();

        // Set default font and font size to match CSS
        $pdf->SetFont('helvetica', '', 13);

        $pdf->Image('img/OFITIC.jpg', 20, 35, 50, 15, 'JPG',"C");

        // Style the report title
        $pdf->SetTextColor(52, 104, 214);  // #3468d8
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Reporte de servicios', 0, 1, 'C');
        $pdf->Ln(10);

        // Style the table
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(204, 204, 204);  // #ccc
        $pdf->SetLineWidth(1);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(10, 6, '#', 1, 0, 'C', 1);
        $pdf->Cell(30, 6, 'Solicitante', 1, 0, 'C', 1);
        $pdf->Cell(25, 6, 'Cedula', 1, 0, 'C', 1);
        $pdf->Cell(60, 6, 'Motivo', 1, 0, 'C', 1);
        $pdf->Cell(20, 6, 'Fecha', 1, 0, 'C', 1);
        $pdf->Cell(20, 6, 'Estado', 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8
        $contador = 0;
        foreach ($datos as $nro => $servicio) {
            $contador++;
            if ($contador === count($datos)) {
                $b = "LRB";
            } else {
                $b = "LR";
            }
            
            $pdf->Cell(10, 6, ($servicio["ID"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
            $pdf->Cell(30, 6, ($servicio["Solicitante"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
            $pdf->Cell(25, 6, ($servicio["Cedula"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
            $pdf->Cell(60, 6, $servicio["Motivo"], $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
            $pdf->Cell(20, 6, (date('m-d-Y', strtotime($servicio["Inicio"]))), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
            $pdf->Cell(20, 6, $servicio["Estatus"], $b, 1, 'C', $nro % 2 === 0 ? 1 : 0);
        }


        ob_clean(); //limpiar la memoria
        // Output the PDF
        $pdf->Output('Resumen_Pedido_' . date('d_m_y') . '.pdf', 'I');

    }


    public function Unidades($datos,$tabla){
        $this->conectar();
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

        // Set margins, header/footer options
        $pdf->SetMargins(20, 35, 25);
        $pdf->SetHeaderMargin(20);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(true);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // Set document information
        $pdf->SetCreator('OFITIC');
        $pdf->SetAuthor('OFITIC');
        $pdf->SetTitle($_SESSION['user']['nombre'] . " reporte " . date('d-m-Y'));

        // Add a page
        $pdf->AddPage();

        $pdf->Image('img/OFITIC.jpg', 20, 35, 50, 15, 'JPG',"C");

        // Style the report title
        $pdf->SetTextColor(52, 104, 214);  // #3468d8
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Reporte de '.$tabla, 0, 1, 'C');
        $pdf->Ln(10);

        // Style the table
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(204, 204, 204);  // #ccc
        $pdf->SetLineWidth(1);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(60, 6, '#', 1, 0, 'C', 1);
        $pdf->Cell(90, 6, $tabla, 1, 1, 'C', 1);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(248, 248, 248);  // #f8f8f8

        
        $contador = 0;
        foreach ($datos as $nro => $servicio) {
            $contador++;
            if ($contador === count($datos)) {
                $b = "LRB";
            } else {
                $b = "LR";
            }

            $pdf->Cell(60, 6, ($servicio["codigo"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
            $pdf->Cell(90, 6, ($servicio["nombre"]), $b, 1, 'C', $nro % 2 === 0 ? 1 : 0);
            
        }


        ob_clean(); //limpiar la memoria
        // Output the PDF
        $pdf->Output('Resumen_Pedido_' . date('d_m_y') . '.pdf', 'I');

    }

    public function equipos($datos){
        $this->conectar();
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);

// Set margins, header/footer options
$pdf->SetMargins(20, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(true);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// Set document information
$pdf->SetCreator('OFITIC');
$pdf->SetAuthor('OFITIC');
$pdf->SetTitle($_SESSION['user']['nombre'] . " reporte " . date('d-m-Y'));

// Add a page
$pdf->AddPage();

$pdf->Image('img/OFITIC.jpg', 20, 35, 50, 15, 'JPG',"C");

// Style the report title
$pdf->SetTextColor(52, 104, 214);  // #3468d8
$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 10, 'Reporte de equipos', 0, 1, 'C');
$pdf->Ln(10);

// Style the table
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(204, 204, 204);  // #ccc
$pdf->SetLineWidth(1);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(10, 6, '#', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'tipo', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'serial', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'marca', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'nro de bien', 1, 1, 'C', 1);

$pdf->SetFont('helvetica', '', 10);
$pdf->SetFillColor(248, 248, 248);  // #f8f8f8
$contador = 0;
        foreach ($datos as $nro => $servicio) {
            $contador++;
            if ($contador === count($datos)) {
                $b = "LRB";
            } else {
                $b = "LR";
            }
    $pdf->Cell(10, 6, ($servicio["id_equipo"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
    $pdf->Cell(30, 6, ($servicio["tipo"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
    $pdf->Cell(35, 6, ($servicio["serial"]), $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
    $pdf->Cell(60, 6, $servicio["marca"], $b, 0, 'C', $nro % 2 === 0 ? 1 : 0);
    $pdf->Cell(30, 6, $servicio["nro_bien"], $b, 1, 'C', $nro % 2 === 0 ? 1 : 0);
    
}


ob_clean(); //limpiar la memoria
// Output the PDF
$pdf->Output('Resumen_Pedido_' . date('d_m_y') . '.pdf', 'I');

    }

}