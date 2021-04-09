<?php 
$FGID = $_GET['formID'];
    $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
//ลบรูป
    $sql = "SELECT * FROM farmergroup WHERE FGID='$FGID'";
    $result = mysqli_query($conn,$sql) or die("Error : ". mysqli_error($conn));
    $objResult = mysqli_fetch_array($result);
    $FGname = $objResult['FGName'];
    $sqlimg = "SELECT * FROM groupphoto WHERE FGID='$FGID'";
    $resultIMG = mysqli_query($conn,$sqlimg) or die("Error : ". mysqli_error($conn));
    while ($row = $resultIMG->fetch_array()) { 
        $imgname=$row['ImageName'];
        $base= "../uploads/$FGname/$imgname";
        unlink("$base");
        } 
    rmdir("../uploads/$FGname/");

    $sqldelegroup = "DELETE FROM farmergroup WHERE FGID=$FGID";
    $sqldelepim = "DELETE FROM groupphoto WHERE FGID=$FGID";
    $sqldeleprod = "DELETE FROM productssale WHERE FGID=$FGID";
    $sqldeleprodpig = "DELETE FROM productpicture WHERE FGID=$FGID";

    $resultgprod = mysqli_query($conn,$sqldelegroup) or die("Error : ". mysqli_error($conn));
    $resultpim = mysqli_query($conn,$sqldelepim) or die("Error : ". mysqli_error($conn));
    $resultprod = mysqli_query($conn,$sqldeleprod) or die("Error : ". mysqli_error($conn));
    $resultprodpig = mysqli_query($conn,$sqldeleprodpig) or die("Error : ". mysqli_error($conn));

    
  
?>
<script type="text/javascript">
  window.location.href = "../showGroupfrom.php";
</script>