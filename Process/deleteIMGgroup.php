<?php
 $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
 $SeriesID = $_GET['SeriesID'];
 $fromID = $_GET['FGID'];
 $sql = "SELECT * FROM farmergroup WHERE FGID='$fromID'";
 $result = mysqli_query($conn,$sql) or die("Error : ". mysqli_error($conn));
 $objResult = mysqli_fetch_array($result);
 $FGname = $objResult['FGName'];
 //
 $sqlimg = "SELECT * FROM groupphoto WHERE SeriesID='$SeriesID'";
 $resultIMG = mysqli_query($conn,$sqlimg) or die("Error : ". mysqli_error($conn));
 while ($row = $resultIMG->fetch_array()) { 
     echo "เข้าwhile";
     $imgname=$row['ImageName'];
     $base= "../uploads/$FGname/$imgname";
     unlink("$base");
     }
$sqldelepim = "DELETE FROM groupphoto WHERE SeriesID=$SeriesID";
$resultpim = mysqli_query($conn,$sqldelepim) or die("Error : ". mysqli_error($conn));
?>
<script type="text/javascript">
  window.location.href = "../EditGroupFrom.php?formID=<?php echo $fromID;?>";
</script>