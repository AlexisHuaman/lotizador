<?php
session_start();
require_once('../vendor/autoload.php');
require_once('../modelo/proyecto.php');


// Verifica si el usuario está autenticado
if (!empty($_SESSION['id_usuario'])) {
    // Verifica si el parámetro 'id' está presente en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $proyectoId = $_GET['id'];
        //$categoria = $_GET['category'];

        $proyecto = new proyecto();
        $proyecto->detalle_proyecto($proyectoId);
        $detalle_proyecto = $proyecto->objeto;

        $aux_numero = 1;
        $transacciones = json_decode(
            $_POST["tabla_transacciones"]
        );
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

        $Saldo_actual = 0;
        $Ganancia = 0;
        $Ventas = 0;
        $Inversison_inicial = 0;
        $Gastos = 0;

        /* Presupuesto del proyecto
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, "Presupuesto del Proyecto: $1500", 0, 1);
        $pdf->Ln(10);*/

        // Tabla de transacciones
        $indice = 0;
        $pdf->SetFont('helvetica', '', 12);
        foreach ($transacciones as $indx => $transaccion) {


            switch ($transaccion->tipo_transaccion_id) {
                case 1:
                    $Saldo_actual += $transaccion->presupuesto;
                    $Inversison_inicial += $transaccion->presupuesto;
                    break;
                case 2:
                    $Saldo_actual -= $transaccion->presupuesto;
                    $Ganancia -= $transaccion->presupuesto;
                    $Gastos += $transaccion->presupuesto;
                    break;
                case 3:
                    $Saldo_actual += $transaccion->presupuesto;
                    $Ventas += $transaccion->presupuesto;
                    $Ganancia += $transaccion->presupuesto;
                    break;
            }
        }
        $pdf->Cell(0, 10, "Inversión Dispuesta: $" . number_format($Inversison_inicial, 2), 0, 1);
        $pdf->Cell(0, 10, "Saldo Actual: $" . number_format($Saldo_actual, 2), 0, 1);
        $pdf->Cell(0, 10, "Ingresos: $" . number_format($Ventas, 2), 0, 1);
        $pdf->Cell(0, 10, "Gastos: $" . number_format($Gastos, 2), 0, 1);
        $pdf->Cell(0, 10, "Ganancia/Perdida: $" . number_format($Ganancia, 2), 0, 1);
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, "Resumen de Transacciones", 0, 1);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(20, 10, 'Número', 1);
        $pdf->Cell(40, 10, 'Tipo', 1);
        $pdf->Cell(30, 10, 'Monto', 1);
        $pdf->Cell(30, 10, 'Fecha', 1);
        $pdf->Cell(70, 10, 'Descripción', 1);
        $pdf->Ln();
        foreach ($transacciones as $indx => $transaccion) {

            $indice++;
            $pdf->Cell(20, 10, $indice, 1);
            $pdf->Cell(40, 10, $transaccion->nombre, 1);
            $pdf->Cell(30, 10, '$' . $transaccion->presupuesto, 1);
            $pdf->Cell(30, 10, $transaccion->fecha, 1);
            $pdf->Cell(70, 10, $transaccion->descripcion, 1);

            switch ($transaccion->tipo_transaccion_id) {
                case 1:
                    $Saldo_actual += $transaccion->presupuesto;
                    $Inversison_inicial += $transaccion->presupuesto;
                    break;
                case 2:
                    $Saldo_actual -= $transaccion->presupuesto;
                    $Ganancia -= $transaccion->presupuesto;
                    $Gastos += $transaccion->presupuesto;
                    break;
                case 3:
                    $Saldo_actual += $transaccion->presupuesto;
                    $Ganancia += $transaccion->presupuesto;
                    break;
            }


            $pdf->Ln();
        }

        $pdf->Ln(10);


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
