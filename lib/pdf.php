<?php

class PdfRecibo
{
    public static function generarRecibo($data)
    {
        require_once 'fpd/fpdf.php';
        $servicio = $data["servicio"];

        // Crear la instancia de FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(95, 50, '', 0, 0, 'C', false);
        if ($servicio == 1)
            $pdf->MultiCell(95, 15, iconv('UTF-8', 'windows-1252', "RECIBO DE \n ENERGIA ELECTRICA"), 0, 'C', false);
        else
            $pdf->MultiCell(95, 15, iconv('UTF-8', 'windows-1252', "RECIBO DE \n AGUA POTABLE"), 0, 'C', false);

        //$imagen_decodificada = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', trim($data["logo"])));
        //$imagen_jpg = imagecreatefromstring($imagen_decodificada); // Crea un recurso de imagen a partir de la cadena decodificada

        $pdf->Image(getcwd() . "/assets/logo/" . $data["logo"], 15, 15, 0, 20,);


        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 4, '', 0, 1);
        $pdf->Cell(120, 10, iconv('UTF-8', 'windows-1252', $data["condominio"]), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 8, iconv('UTF-8', 'windows-1252', "N° RECIBO"), 1, 0, 'L');
        $pdf->Cell(30, 8, iconv('UTF-8', 'windows-1252', $data["recibo"]), 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(120, 10, iconv('UTF-8', 'windows-1252', $data["direccion"]), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 8, iconv('UTF-8', 'windows-1252', "N° SUMINISTRO"), 1, 0, 'L');
        $pdf->Cell(30, 8, iconv('UTF-8', 'windows-1252', $data["suministro"]), 1, 1, 'L');
        $pdf->Line(8, 65, 202, 65);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, '', 0, 1);
        $pdf->Cell(0, 15, 'DATOS DEL CLIENTE', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "Nombre:"), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(130, 10, iconv('UTF-8', 'windows-1252', $data["nombres"]), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "DNI:"), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', $data["documento"]), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "Dirección:"), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(90, 10, iconv('UTF-8', 'windows-1252', $data["condominio"]), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "Mz.:"), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', $data["manzana"]), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "Lt.:"), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', $data["lote"]), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(32, 10, iconv('UTF-8', 'windows-1252', "Departamento:"), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(32, 10, iconv('UTF-8', 'windows-1252', $data["departamento"]), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(32, 10, iconv('UTF-8', 'windows-1252', "Provincia:"), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(32, 10, iconv('UTF-8', 'windows-1252', $data["provincia"]), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(32, 10, iconv('UTF-8', 'windows-1252', "Distrito:"), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(32, 10, iconv('UTF-8', 'windows-1252', $data["distrito"]), 0, 1, 'L');
        $pdf->Line(8, 115, 202, 115);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, '', 0, 1);
        $pdf->Cell(0, 15, 'DETALLES DEL IMPORTE FACTURADO', 0, 1);

        if ($servicio == 1) {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(110, 7, iconv('UTF-8', 'windows-1252', "Lectura anterior"), 0, 0, 'L');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["inicial"] . " KW"), 0, 0, 'R');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'R');

            $pdf->Cell(110, 7, iconv('UTF-8', 'windows-1252', "Lectura actual"), 0, 0, 'L');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["medicion"] . " KW"), 0, 0, 'R');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["monto"]), 0, 1, 'R');

            $pdf->Cell(110, 7, iconv('UTF-8', 'windows-1252', "Mantenimiento sub-estación"), 0, 0, 'L');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', ""), 0, 0, 'R');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["mantenimiento"]), 0, 1, 'R');

            $pdf->Cell(110, 7, iconv('UTF-8', 'windows-1252', "Alumbrado público"), 0, 0, 'L');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', ""), 0, 0, 'R');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["alumbrado"]), 0, 1, 'R');

            $pdf->Cell(110, 7, iconv('UTF-8', 'windows-1252', "Lectura"), 0, 0, 'L');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["registro"]), 0, 0, 'R');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'R');
        } else {

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(110, 7, iconv('UTF-8', 'windows-1252', "Consumo"), 0, 0, 'L');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["medicion"]), 0, 0, 'R');
            $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["monto"]), 0, 1, 'R');
        }

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(70, 7, "", 0, 0, 'L', false);
        $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', "Sub-total"), 0, 0, 'R');
        $pdf->Cell(40, 7, "", 0, 0, 'R');
        $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["subtotal"]), 0, 1, 'R');

        $pdf->Cell(70, 7, "", 0, 0, 'L', false);
        $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', "Deuda Vencida"), 0, 0, 'R');
        $pdf->Cell(40, 7, "", 0, 0, 'R');
        $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["deuda"]), 0, 1, 'R');

        $pdf->Cell(70, 7, "", 0, 0, 'L', false);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', "Total"), 0, 0, 'R');
        $pdf->Cell(40, 7, "", 0, 0, 'R');
        $pdf->Cell(40, 7, iconv('UTF-8', 'windows-1252', $data["total"]), 0, 1, 'R');

        if ($servicio == 2)
            $pdf->Cell(120, 28, iconv('UTF-8', 'windows-1252', ""), 0, 1, 'R');

        $pdf->Line(8, 190, 202, 190);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, "", 0, 1, 'L', false);
        $pdf->Cell(45, 10, "", 0, 0, 'L', false);
        $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', "Fecha de emisión"), 1, 0, 'C');
        $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', "Fecha de vencimiento"), 1, 1, 'C');
        $pdf->Cell(45, 10, "", 0, 0, 'L', false);
        $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', $data["emision"]), 1, 0, 'C');
        $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', $data["vencimiento"]), 1, 1, 'C');

        $pdf->Cell(0, 30, "", 0, 1, 'L', false);

        $pdf->MultiCell(190, 10, iconv('UTF-8', 'windows-1252', "Cuentas de ahorro BCP: 12345678912365 / CCI: 123032133123123132 / Yape: 923456789\n" .
            "Dilsi Amabel Arevalo Leon\n" .
            "Gerente de AYC Constructora SAC"), 1, 'C', false);

        $pdf->Output();
        // Descargar el archivo PDF
        //$pdf->Output('D', 'mi_archivo.pdf');

    }
}
