<?php 
session_start();
require('fpdf/fpdf.php');
$dataVille = $_SESSION["ACCES_INFORMATION_Reg"];
$pdf = new FPDF("P","pt","A4");
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0,$dataVille);
$pdf->Cell(0,0,$dataDept);
$pdf->Cell(0,0,$dataReg);
$pdf->Output();
?>