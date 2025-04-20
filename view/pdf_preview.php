<?php
if(!isset($_SESSION['pdf_preview']) {
    die('No hay PDF para previsualizar');
}

$pdfFile = $_SESSION['pdf_preview'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vista Previa del PDF</title>
    <style>
        body { margin: 0; padding: 20px; }
        .pdf-container { width: 100%; height: 90vh; border: 1px solid #ccc; }
        .toolbar { margin-bottom: 10px; text-align: center; }
        .btn { padding: 8px 15px; margin: 0 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="toolbar">
        <button class="btn" onclick="window.print()">Imprimir</button>
        <button class="btn" onclick="downloadPDF()">Descargar</button>
        <button class="btn" onclick="window.close()">Cerrar</button>
    </div>
    
    <iframe class="pdf-container" src="data:application/pdf;base64,<?= base64_encode(file_get_contents($pdfFile)) ?>"></iframe>

    <script>
    function downloadPDF() {
        const link = document.createElement('a');
        link.href = "data:application/pdf;base64,<?= base64_encode(file_get_contents($pdfFile)) ?>";
        link.download = "reporte_<?= basename($pdfFile) ?>.pdf";
        link.click();
    }
    </script>
</body>
</html>
<?php
unlink($pdfFile); // Eliminar el archivo temporal
unset($_SESSION['pdf_preview']);
?>