<?php
session_start();
require_once('../vendor/autoload.php');
require_once('../modelo/proyecto.php');


// Verifica si el usuario está autenticado
if (!empty($_SESSION['id_usuario'])) {
    // Verifica si el parámetro 'id' está presente en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $proyectoId = $_GET['id'];
        $categoria = $_GET['category'];

        $proyecto = new proyecto();
        $proyecto->listarTransacciones($proyectoId);
        $transacciones = $proyecto->objeto;
        $proyecto->detalle_proyecto($proyectoId);
        $detalle_proyecto = $proyecto->objeto;

        $aux_numero = 1;

        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF();

        // Agregar una página
        $pdf->AddPage();

        // Configurar la fuente
        $pdf->SetFont('helvetica', '', 12);

        // Título del proyecto
        $pdf->Cell(0, 10, 'Informe del Proyecto', 0, 1, 'C');
        $pdf->Ln(10);

        // Nombre del proyecto
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, "Nombre del Proyecto: $detalle_proyecto->nombre", 0, 1);
        $pdf->Ln(5);

        // Presupuesto del proyecto
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, "Presupuesto del Proyecto: $1500", 0, 1);
        $pdf->Ln(10);

        // Tabla de transacciones
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(20, 10, 'Número', 1);
        $pdf->Cell(40, 10, 'Tipo', 1);
        $pdf->Cell(30, 10, 'Monto', 1);
        $pdf->Cell(30, 10, 'Fecha', 1);
        $pdf->Cell(70, 10, 'Descripción', 1);
        $pdf->Ln();

        $pdf->SetFont('helvetica', 'B', 12);
        $indice = 0;
        foreach ($transacciones as $indx => $transaccion) {
            if ($categoria !== "0") {
                $filter_transaccion;
                switch ($categoria) {
                    case "1":
                        # code...
                        $filter_transaccion = $transaccion->tipo_transaccion_id === 1 ? $transaccion : null;


                        break;
                    case "2":
                        # code...
                        $filter_transaccion = $transaccion->tipo_transaccion_id === 2 ? $transaccion : null;


                        break;
                    case "3":
                        # code...
                        $filter_transaccion = $transaccion->tipo_transaccion_id === 3 ? $transaccion : null;


                        break;

                    default:
                        # code...
                        break;
                }
                if ($filter_transaccion !== null) {
                    $indice++;
                    $pdf->Cell(20, 10, $indice, 1);
                    $pdf->Cell(40, 10, $filter_transaccion->nombre, 1);
                    $pdf->Cell(30, 10, '$' . $filter_transaccion->presupuesto, 1);
                    $pdf->Cell(30, 10, $filter_transaccion->fecha, 1);
                    $pdf->Cell(70, 10, $filter_transaccion->descripcion, 1);
                    $pdf->Ln();
                }
            } else {
                $indice++;
                $pdf->Cell(20, 10, $indice, 1);
                $pdf->Cell(40, 10, $transaccion->nombre, 1);
                $pdf->Cell(30, 10, '$' . $transaccion->presupuesto, 1);
                $pdf->Cell(30, 10, $transaccion->fecha, 1);
                $pdf->Cell(70, 10, $transaccion->descripcion, 1);
                $pdf->Ln();
            }
        }

        // Muestra el PDF en el navegador o guarda el archivo
        $pdf->Output('informe_proyecto.pdf', 'I'); // 'I' para mostrar en el navegador, 'D' para descargar


        // En este punto, $nombreProyecto tendrá el nombre del proyecto
        // o `null` si no se encontró ningún proyecto con ese ID.
    } else {
        echo "ID de proyecto no proporcionado.";
        exit;
    }
} else {
    header('Location: ../vista/index.php');
    exit;
}
