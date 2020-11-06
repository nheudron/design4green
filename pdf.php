<?php
define("FPDF_FONTPATH","/"); 
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0,$dataVille);
$pdf->Cell(0,0,$dataDept);
$pdf->Cell(0,0,$dataReg);
$pdf->Output();
?>