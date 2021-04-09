<?php
$conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
$Productssale = $_GET['Productssale'];
$join = "SELECT productssale.PID, farmergroup.FGName,farmergroup.FGID, product.Pname
FROM productssale
INNER JOIN farmergroup
ON productssale.FGID = farmergroup.FGID INNER JOIN product ON productssale.PID = product.PID WHERE productssale.Productssale ='$Productssale'";
// $sql = "SELECT * FROM farmergroup WHERE FGID='$FGID'";
$result = mysqli_query($conn,$join) or die("Error : ". mysqli_error($conn));
$objResult = mysqli_fetch_array($result, MYSQLI_ASSOC);
// print_r($objResult);
$FGname = $objResult['FGName'];
$Pname =  $objResult['Pname'];
$FGID = $objResult['FGID'];
    $sqlimg = "SELECT * FROM productpicture WHERE Productssale='$Productssale'";
    $resultIMG = mysqli_query($conn,$sqlimg) or die("Error : ". mysqli_error($conn));
    while ($row = $resultIMG->fetch_array()) { 
        $imgname=$row['ImageName'];
        $base= "../uploads/$FGname/$Pname/$imgname";
        unlink("$base");
        } 
    rmdir("../uploads/$FGname/$Pname/");
    $sqlIMG= "DELETE FROM productpicture WHERE Productssale='$Productssale'";
    $resultIMG = mysqli_query($conn,$sqlIMG) or die("Error : ". mysqli_error($conn));
    $sqldeleprod = "DELETE FROM productssale WHERE Productssale='$Productssale'";
    $resultprod = mysqli_query($conn,$sqldeleprod) or die("Error : ". mysqli_error($conn));
?>
<script type="text/javascript">
  window.location.href = "../EditProductsSale.php?formID=<?php echo $FGID; ?>";
</script>