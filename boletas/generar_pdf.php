<?php
require '../fpdf/fpdf.php';
require '../conexion.php';

if (!isset($_GET['id'])) {
    die('ID de boleta no especificado.');
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM boletas WHERE id = ?");
$stmt->execute([$id]);
$boleta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$boleta) {
    die('Boleta no encontrada.');
}

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('BOLETA DE SERVICIO'), 0, 1, 'C');
$pdf->Ln(10);

// Encabezado del cliente
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('Datos del Cliente'), 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, utf8_decode('Nombre:'), 0);
$pdf->Cell(0, 8, utf8_decode($boleta['nombre_cliente']), 0, 1);

$pdf->Cell(50, 8, 'DNI:', 0);
$pdf->Cell(0, 8, utf8_decode($boleta['dni_cliente']), 0, 1);

$pdf->Cell(50, 8, utf8_decode('Teléfono:'), 0);
$pdf->Cell(0, 8, utf8_decode($boleta['telefono_cliente']), 0, 1);

$pdf->Cell(50, 8, 'Correo:', 0);
$pdf->Cell(0, 8, utf8_decode($boleta['correo_cliente']), 0, 1);

$pdf->Ln(10);

// Información del servicio
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('Detalles del Servicio'), 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 8, utf8_decode('Producto dejado:'), 0);
$pdf->Cell(0, 8, utf8_decode($boleta['producto_dejado']), 0, 1);

$pdf->Cell(50, 8, utf8_decode('Servicio a realizar:'), 0);
$pdf->Cell(0, 8, utf8_decode($boleta['servicio_a_realizar']), 0, 1);

$pdf->Cell(50, 8, utf8_decode('Razón del cobro:'), 0, 1);
$pdf->MultiCell(0, 8, utf8_decode($boleta['rason']), 0);

$pdf->Ln(10);

// Costos y fecha
$pdf->Cell(50, 8, utf8_decode('Costo total:'), 0);
$pdf->Cell(0, 8, 'S/ ' . number_format($boleta['costo_total'], 2), 0, 1);

$pdf->Cell(50, 8, utf8_decode('Fecha de emisión:'), 0);
$pdf->Cell(0, 8, utf8_decode($boleta['fecha_emision']), 0, 1);

// Salida
$pdf->Output();
