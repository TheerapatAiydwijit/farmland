<?php
$conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
$imgname = $_GET['IMGname'];
$formID =$_GET['formID'];
$targeat = "../$imgname";
unlink("$targeat");
$nameImge = (explode("/",$imgname,4));
$name = $nameImge[3];
$sqldelepim = "DELETE FROM productpicture WHERE ImageName='$name'";
$resultpim = mysqli_query($conn,$sqldelepim) or die("Error : ". mysqli_error($conn));
?>
<script type="text/javascript">
  window.location.href = "../EditProductsSale.php?formID=<?php echo $formID; ?>";
</script>