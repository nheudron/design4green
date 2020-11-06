<?php 
session_start();
require('fpdf/fpdf.php');
$ACCES_INFORMATION_Ville = $_SESSION["ACCES_INFORMATION_Ville"];
$ACCES_INTERFACES_NUMERIQUES_Ville = $_SESSION["ACCES_INTERFACES_NUMERIQUES_Ville"];
$COMPETENCES_ADMINISTRATIVES_Ville = $_SESSION["COMPETENCES_ADMINISTRATIVES_Ville"];
$COMPETENCES_SCOLAIRES_Ville = $_SESSION["COMPETENCES_SCOLAIRES_Ville"];
$GLOBAL_ACCES_Ville = $_SESSION["GLOBAL_ACCES_Ville"];
$GLOBAL_COMPETENCES_Ville = $_SESSION["GLOBAL_COMPETENCES_Ville"];
$SCORE_GLOBAL_Ville = $_SESSION["SCORE_GLOBAL_Ville"];

$ACCES_INFORMATION_Dep = $_SESSION["ACCES_INFORMATION_Dep"];
$ACCES_INTERFACES_NUMERIQUES_Dep = $_SESSION["ACCES_INTERFACES_NUMERIQUES_Dep"];
$COMPETENCES_ADMINISTRATIVES_Dep = $_SESSION["COMPETENCES_ADMINISTRATIVES_Dep"];
$COMPETENCES_SCOLAIRES_Dep = $_SESSION["COMPETENCES_SCOLAIRES_Dep"];
$GLOBAL_ACCES_Dep = $_SESSION["GLOBAL_ACCES_Dep"];
$GLOBAL_COMPETENCES_Dep = $_SESSION["GLOBAL_COMPETENCES_Dep"];
$SCORE_GLOBAL_Dep = $_SESSION["SCORE_GLOBAL_Dep"];

$ACCES_INFORMATION_Reg = $_SESSION["ACCES_INFORMATION_Reg"];
$ACCES_INTERFACES_NUMERIQUES_Reg = $_SESSION["ACCES_INTERFACES_NUMERIQUES_Reg"];
$COMPETENCES_ADMINISTRATIVES_Reg = $_SESSION["COMPETENCES_ADMINISTRATIVES_Reg"];
$COMPETENCES_SCOLAIRES_Reg = $_SESSION["COMPETENCES_SCOLAIRES_Reg"];
$GLOBAL_ACCES_Reg = $_SESSION["GLOBAL_ACCES_Reg"];
$GLOBAL_COMPETENCES_Reg = $_SESSION["GLOBAL_COMPETENCES_Reg"];
$SCORE_GLOBAL_Reg = $_SESSION["SCORE_GLOBAL_Reg"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,"indices de la ville :");
$pdf->Ln();
$pdf->Cell(20,10,"Accès à l'information : " . $ACCES_INFORMATION_Ville);
$pdf->Ln();
$pdf->Cell(20,10,"Accès aux interfaces numériques : " . $ACCES_INTERFACES_NUMERIQUES_Ville);
$pdf->Ln();
$pdf->Cell(20,10,"Compétences administratives : " . $COMPETENCES_ADMINISTRATIVES_Ville);
$pdf->Ln();
$pdf->Cell(20,10,"Compétences numériques/scolaires :" . $COMPETENCES_SCOLAIRES_Ville);
$pdf->Ln();
$pdf->Cell(20,10,"Accès Global : " . $GLOBAL_ACCES_Ville);
$pdf->Ln();
$pdf->Cell(20,10,"Compétence Global : " . $GLOBAL_COMPETENCES_Ville);
$pdf->Ln();
$pdf->Cell(20,10,"SCORE GLOBAL : " . $SCORE_GLOBAL_Ville);
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(0,10,"indices de la ville :");
$pdf->Ln();
$pdf->Cell(20,10,"Accès à l'information : " . $ACCES_INFORMATION_Dep);
$pdf->Ln();
$pdf->Cell(20,10,"Accès aux interfaces numériques : " . $ACCES_INTERFACES_NUMERIQUES_Dep);
$pdf->Ln();
$pdf->Cell(20,10,"Compétences administratives : " . $COMPETENCES_ADMINISTRATIVES_Dep);
$pdf->Ln();
$pdf->Cell(20,10,"Compétences numériques/scolaires :" . $COMPETENCES_SCOLAIRES_Dep);
$pdf->Ln();
$pdf->Cell(20,10,"Accès Global : " . $GLOBAL_ACCES_Dep);
$pdf->Ln();
$pdf->Cell(20,10,"Compétence Global : " . $GLOBAL_COMPETENCES_Dep);
$pdf->Ln();
$pdf->Cell(20,10,"SCORE GLOBAL : " . $SCORE_GLOBAL_Dep);
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(0,10,"indices de la ville :");
$pdf->Ln();
$pdf->Cell(20,10,"Accès à l'information : " . $ACCES_INFORMATION_Reg);
$pdf->Ln();
$pdf->Cell(20,10,"Accès aux interfaces numériques : " . $ACCES_INTERFACES_NUMERIQUES_Reg);
$pdf->Ln();
$pdf->Cell(20,10,"Compétences administratives : " . $COMPETENCES_ADMINISTRATIVES_Reg);
$pdf->Ln();
$pdf->Cell(20,10,"Compétences numériques/scolaires :" . $COMPETENCES_SCOLAIRES_Reg);
$pdf->Ln();
$pdf->Cell(20,10,"Accès Global : " . $GLOBAL_ACCES_Reg);
$pdf->Ln();
$pdf->Cell(20,10,"Compétence Global : " . $GLOBAL_COMPETENCES_Reg);
$pdf->Ln();
$pdf->Cell(20,10,"SCORE GLOBAL : " . $SCORE_GLOBAL_Reg);

$pdf->Output();
?>