<?php 
$conn = mysqli_connect("localhost", "root", "", "farmland") or die("Error: " . mysqli_error($conn));
$sele =" SELECT * FROM product
WHERE Pname LIKE '%ผัก%'";
$resuProductssale = mysqli_query($conn, $sele);
while($row = mysqli_fetch_array($resuProductssale)){
    echo $row['PID'];
    echo $row['Pname'];
    echo "<br>";
}
?>