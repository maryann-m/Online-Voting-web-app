<?php
include('database.php');
$database = new Database();
$result = $database->runQuery("SELECT id,firstname,lastname,voters_id FROM voters");
$header = $database->runQuery("SELECT UCASE(`COLUMN_NAME`) 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='crud' 
AND `TABLE_NAME`='voters'
and `COLUMN_NAME` in ('id','firstname','lastname','voters_id')");


require('C:\wamp64\www\votesystem\votesystem\admin\fpdf183\fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$width_cell=array(20,40,40,40);
$pdf->SetFont('Arial','B',12);

foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(45,12,$column_heading,1);
}
foreach($result as $row) {
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(45,12,$column,1);
}
ob_end_clean(); 
$pdf->Output('Voting Codes.pdf', 'I');
?>

