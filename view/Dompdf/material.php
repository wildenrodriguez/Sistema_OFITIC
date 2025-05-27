<?php $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Materiales</title>
            <style>
                body { font-family: Arial; }
                h1 { color: #444; text-align: center; }
                table { width: 100%; border-collapse: collapse; }
                th { background-color: #f2f2f2; text-align: left; }
                td, th { border: 1px solid #ddd; padding: 8px; }
            </style>
        </head>
        <body>
            <h1>Reporte de Materiales</h1>
            <p>Período: ' . $_POST['fecha_inicio'] . ' al ' . $_POST['fecha_fin'] . '</p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>';

			foreach ($resultado['datos'] as $material) {
				$html .= '
                    <tr>
                        <td>' . $material['id_material'] . '</td>
                        <td>' . $material['nombre_material'] . '</td>
                        <td>' . $material['nombre_oficina'] . '</td>
                        <td>' . $material['stock'] . '</td>
                    </tr>';
			}

			$html .= '
                </tbody>
            </table>
        </body>
        </html>';