<?php 
// require('../PDFProcess/fpdf.php'); 
include('pdf_mc_table.php');
$PID = 2;
// $str = iconv('UTF-8', 'windows-1252', $str);
$pdf = new PDF_MC_TABLE('L','mm','a4');
$pdf -> AddPage();
$pdf ->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf ->AddFont('THSarabunNew','B','THSarabunNew_b.php');
$pdf ->SetFont('THSarabunNew','B','15');
$pdf ->SetWidths(Array(13,30,60,65,30,30,35));
$pdf ->SetLineHeight(7);
$conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
$header=array('ลำดับ','ชื่อสินค้า','ชื่อกลุ่ม','ที่อยู่','มาตรฐาน','ราคา','เบอร์ติดต่อ');
$pdf ->cell('','10',iconv('UTF-8', 'TIS-620', $PID),'0','1','C');
$pdf ->SetFont('THSarabunNew','B','25');
$pdf ->cell('13','10',iconv('UTF-8', 'TIS-620', $header[0]),'1','0','C');
$pdf ->cell('30','10',iconv('UTF-8', 'TIS-620', $header[1]),'1','0','C');
$pdf ->cell('60','10',iconv('UTF-8', 'TIS-620', $header[2]),'1','0','C');
$pdf ->cell('65','10',iconv('UTF-8', 'TIS-620', $header[3]),'1','0','C');
$pdf ->cell('30','10',iconv('UTF-8', 'TIS-620', $header[4]),'1','0','C');
$pdf ->cell('30','10',iconv('UTF-8', 'TIS-620', $header[5]),'1','0','C');
$pdf ->cell('35','10',iconv('UTF-8', 'TIS-620', $header[6]),'1','1','C');
// $pdf -> Ln();
// $conn->set_charset("windows-1252");
$selejoin = "SELECT * FROM productssale INNER JOIN farmergroup 
ON productssale.FGID = farmergroup.FGID 
INNER JOIN product ON productssale.PID = product.PID 
WHERE productssale.PID ='$PID'";
$result = mysqli_query($conn,$selejoin) or die("Error : ". mysqli_error($conn));
$pdf -> SetAligns(Array('C','C','C','C','C','C','C'));
$pdf ->SetFont('THSarabunNew','','20');
$order = 1;
while($objResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    if($objResult['standard_Q']=="1"){
        $standard_Q = "Q";
    }
    else{
        $standard_Q = "-";
    }
    if($objResult['standard_GAP']=="1"){
        $standard_GAP = "GAP";
    }
    else{
        $standard_GAP= "-";
    }
    if($objResult['standard_GMP']=="1"){
        $standard_GMP = "GMP";
    }
    else{
        $standard_GMP = "-";
    }
    $Standard = $standard_Q." ".$standard_GAP." ".$standard_GMP; 
    $Price = $objResult['Price']." / ".$objResult['Unit'];
   $pdf ->Row(array(
    iconv('UTF-8', 'TIS-620', $order),
    iconv('UTF-8', 'TIS-620', $objResult['Pname']),
    iconv('UTF-8', 'TIS-620', $objResult['FGName']),
    iconv('UTF-8', 'TIS-620', $objResult['FGLo']),
    iconv('UTF-8', 'TIS-620', $Standard),
    iconv('UTF-8', 'TIS-620', $Price),
    iconv('UTF-8', 'TIS-620', $objResult['PhoneG']),
   ));
    $order++;
}
$pdf->Output();
?>
<!-- $PID = 2;
$conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
// $conn->set_charset("windows-1252");
$selejoin = "SELECT * FROM productssale INNER JOIN farmergroup 
ON productssale.FGID = farmergroup.FGID 
INNER JOIN product ON productssale.PID = product.PID 
WHERE productssale.PID ='$PID'";
$result = mysqli_query($conn,$selejoin) or die("Error : ". mysqli_error($conn));
$header=array('ลำดับ','ชื่อสินค้า','ชื่อกลุ่ม','ที่อยู่','มาตรฐาน','ราคา','เบอร์ติดต่อ');

$pdf = new FPDF('L','mm','a4');
    $pdf ->AddFont('THSarabunNew','','THSarabunNew.php');
    $pdf ->AddFont('THSarabunNew','B','THSarabunNew_b.php');
    $pdf ->SetFont('THSarabunNew','B','36');
    $pdf ->AddPage();
    $pdf ->cell('','10',iconv('UTF-8', 'TIS-620', $PID),'0','1','C');
    $pdf ->SetFont('THSarabunNew','B','18');
    $pdf ->cell('15','10',iconv('UTF-8', 'TIS-620', $header[0]),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $header[1]),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $header[2]),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $header[3]),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $header[4]),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $header[5]),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $header[6]),'1','1','C');
$order = 1;
while($objResult = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $pdf ->cell('15','10',iconv('UTF-8', 'TIS-620', $order),'1','0','C');
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $objResult['Pname']),'1','0','C'); 
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $objResult['FGName']),'1','0','C'); 
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $objResult['FGLo']),'1','0','C');
    if($objResult['standard_Q']=="1"){
        $standard_Q = "Q";
    }
    else{
        $standard_Q = "-";
    }
    if($objResult['standard_GAP']=="1"){
        $standard_GAP = "GAP";
    }
    else{
        $standard_GAP= "-";
    }
    if($objResult['standard_GMP']=="1"){
        $standard_GMP = "GMP";
    }
    else{
        $standard_GMP = "-";
    }
    $Standard = $standard_Q." ".$standard_GAP." ".$standard_GMP; 
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $Standard),'1','0','C'); 
    $Price = $objResult['Price']." / ".$objResult['Unit'];
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $Price),'1','0','C'); 
    $pdf ->cell('40','10',iconv('UTF-8', 'TIS-620', $objResult['PhoneG']),'1',$order,'C'); 
    $order++;
}
$pdf->Output(); -->