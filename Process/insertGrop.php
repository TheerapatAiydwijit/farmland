<?php
date_default_timezone_set('asia/bangkok');
$Unit =date('dmyis');
$random = rand(0,9);
$Unit .=$random;
 $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
 $FGID= $Unit;
 $FGName = (isset($_POST['FGName'])?$_POST['FGName']:'-');
 $NumF= (isset($_POST['NumF'])?$_POST['NumF']:'-');
 $Area = (isset($_POST['Area'])?$_POST['Area']:'-');
 $FGLo = (isset($_POST['FGLo'])?$_POST['FGLo']:'-');
 $Latitude = (isset($_POST['Latitude'])?$_POST['Latitude']:'-');
 $Longitude = (isset($_POST['Longitude'])?$_POST['Longitude']:'-');
 $Gpresid =(isset($_POST['Gpresid'])?$_POST['Gpresid']:'-');
 $Phone = (isset($_POST['Phone'])?$_POST['Phone']:'-');
 $Facebook = (isset($_POST['Facebook'])?$_POST['Facebook']:'-');
 $Instagram = (isset($_POST['Instagram'])?$_POST['Instagram']:'-');
 $LINE =(isset($_POST['LINE'])?$_POST['LINE']:'-');
 $Twitter = (isset($_POST['Twitter'])?$_POST['Twitter']:'-');
 $Web = (isset($_POST['Web'])?$_POST['Web']:'-');
 $PhoneG = (isset($_POST['PhoneG'])?$_POST['PhoneG']:'-');
 $sql = "INSERT INTO farmergroup
 VALUES ('$Unit','$FGName', '$NumF', '$Area', '$FGLo', '$Latitude','$Longitude', '$Gpresid', '$Phone', '$Facebook', '$Instagram', '$LINE', '$Twitter', '$Web', '$PhoneG')";
 $result = mysqli_query($conn,$sql) or die("Error : ". mysqli_error($conn));
//อัพโหลดรูป
if(isset($_POST['submit'])){ 
  // File upload configuration 
  mkdir("../uploads/$FGName/");
  $targetDir = "../uploads/$FGName/"; 
  $allowTypes = array('jpg','png','jpeg','gif'); 
  $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
  $fileNames = array_filter($_FILES['files']['name']); 
 $i=1;
  if(!empty($fileNames)){ 
      foreach($_FILES['files']['name'] as $key=>$val){ 
          // File upload path 
          $fileName = basename($_FILES['files']['name'][$key]); //ได้ชื่ออย่างเดียวไม่เอาเลยkey
          $fileType = pathinfo($fileName, PATHINFO_EXTENSION);//แยกนามสกุลไฟล์ออกมา
          $fileName = $FGID."_$i".".".$fileType;//เปลี่ยนชื่อไฟล์
          $targetFilePath = $targetDir . $fileName; //เอาชื่อ+ที่อยู่
          // Check whether file type is valid 
          if(in_array($fileType, $allowTypes)){ 
              // Upload file to server 
              if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                  // Image db insert sql 
                  $sql = "INSERT INTO groupphoto (FGID,ImageName)
                      VALUES ('$FGID','$fileName')";
                      $result = mysqli_query($conn,$sql) or die("Error : ". mysqli_error($conn));
                      $i++;
              }else{ 
                echo "Sorry, there was an error uploading your file.";
              } 
          }
      } 
  }else{ 
      $statusMsg = 'Please select a file to upload.'; 
  } 
   
  // Display status message 
  echo $statusMsg; 
} 
//จบอัพรูป
?>
<script type="text/javascript">
  window.location.href = "../ProductsSale.php?formID=<?php echo $FGID; ?>";
</script>