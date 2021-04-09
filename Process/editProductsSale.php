<?php  
$conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
$FGID = $_GET['formID'];
$selectGRUPSELE = "SELECT * FROM productssale WHERE FGID='$FGID'";
$resultPro = mysqli_query($conn,$selectGRUPSELE);
$PID = (isset($_POST['PID']) ? $_POST['PID']:'Null');
$Pname = (isset($_POST['Pname']) ? $_POST['Pname']:'Null');
$PVolume = (isset($_POST['PVolume']) ? $_POST['PVolume']:'Null');
$PCycle = (isset($_POST['PCycle']) ? $_POST['PCycle']:'Null');
$Ptime = (isset($_POST['Ptime']) ? $_POST['Ptime']:'Null');
$price = (isset($_POST['price']) ? $_POST['price']:'Null');
$Unit = (isset($_POST['Unit']) ? $_POST['Unit']:'Null');
$standard_Q = (isset($_POST['standard_Q']) ? $_POST['standard_Q']:'0');
$standard_GAP = (isset($_POST['standard_GAP']) ? $_POST['standard_GAP']:'0');
$standard_GMP = (isset($_POST['standard_GMP']) ? $_POST['standard_GMP']:'0');
print_r($PID);
echo "<br>";
$namegroup = "SELECT * FROM farmergroup where FGID='$FGID'";
$resultname = mysqli_query($conn, $namegroup);
$objname = mysqli_fetch_array($resultname);
$FGName = $objname['FGName'];
// $clout = count($PID);
// echo $clout;
while($comparevalue = mysqli_fetch_array($resultPro, MYSQLI_ASSOC)){
                $test[] = $comparevalue['PID'];
}
// print_r($test);
$allowTypes = array('jpg','png','jpeg','gif'); 
$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
$i = 0;
foreach($PID as $keyP => $valP) {
    if($standard_Q[$i]=="ไม่มี"){
        $standard_Q[$i] = 0;
    }
    else{
        $standard_Q[$i] = 1;
    }
    if($standard_GAP[$i]=="ไม่มี"){
        $standard_GAP[$i] = 0;
    }
    else{
        $standard_GAP[$i] = 1;
    }
    if($standard_GMP[$i]=="ไม่มี"){
        $standard_GMP[$i] = 0;
    }
    else{
        $standard_GMP[$i] = 1;
    }
    error_reporting (E_ALL & ~ E_NOTICE);
        $valueckek = $valP == $test[$i] ? "true" : "false"; 
        error_reporting (E_ALL);
        if($PID[$i]==0){
            $insetP = "INSERT INTO product (Pname) VALUES ('$Pname[$i]')";
            $resultP = mysqli_query($conn,$insetP) or die("Error : ". mysqli_error($conn));
            $SELECT = "SELECT * FROM product WHERE Pname='$Pname[$i]'";
            $resultSelectPID = mysqli_query($conn,$SELECT) or die("Error : ". mysqli_error($conn));
            $row =$resultSelectPID->fetch_array();
            $PID[$i] =$row['PID'];
        }
        if($valueckek === "true"){
            $insetPS = "UPDATE productssale SET 
            PVolume ='$PVolume[$i]',
            PCycle ='$PCycle[$i]',
            Ptime ='$Ptime[$i]',
            Price ='$price[$i]',
            Unit ='$Unit[$i]',
            standard_Q ='$standard_Q[$i]',
            standard_GAP ='$standard_GAP[$i]',
            standard_GMP ='$standard_GMP[$i]'
            WHERE FGID='$FGID' AND PID='$PID[$i]'";
        }   
        else{
            $insetPS = "INSERT INTO productssale (FGID,PID,PVolume,PCycle,Ptime,Price,Unit,standard_Q,standard_GAP,standard_GMP)
            VALUES ('$FGID', '$PID[$i]', '$PVolume[$i]', '$PCycle[$i]', '$Ptime[$i]', '$price[$i]', '$Unit[$i]', '$standard_Q[$i]', '$standard_GAP[$i]', '$standard_GMP[$i]')";
            //  mkdir("../uploads/$FGName/$Pname[$i]/");
        }
        $resultPS = mysqli_query($conn,$insetPS) or die("Error : ". mysqli_error($conn));
        $SELECTproduct = "SELECT * FROM product WHERE PID='$PID[$i]'";
        $resultnameP = mysqli_query($conn, $SELECTproduct);
        $objnameP = mysqli_fetch_array($resultnameP);
        $Pname = $objnameP['Pname'];
        $nameArray[] = $objnameP['Pname'];
        $structure = "../uploads/$FGName/$Pname/";
        $resultis_dir = is_dir($structure);
        if (is_dir($structure)){
        echo ("$Pname is a directory");
        } 
    
        else{
        echo ("$Pname is not a directory"); 
        mkdir($structure);
        }
        echo "<br>";
        $i++;
}
// print_r($nameArray);
// print_r($_FILES['upload']['name']);
foreach($_FILES['upload']['name'] as $key=>$val){
    $MainArray = $key - 1;
    $SubArray =array();
    //ใช้ในการระบบุอาเรหลัแต่เนื่องจากการนับคือ เริ่มจาก 0 จึงต้องนับมาลบ 1 เพราะค่าการนับอาเรที่ได้มาเริ่มจาก 0
    $chek = $_FILES['upload']['name'][$key][0];
    // // echo $chek;
    // if($chek !="")
    // echo "dawdawdawd";
    // echo "<br>";
    if($chek !=""){ 
        $SQLProductssale = "SELECT Productssale FROM productssale where FGID='$FGID' and PID='$PID[$MainArray]'";
        $resuProductssale = mysqli_query($conn, $SQLProductssale);
        $objProductssale = mysqli_fetch_array($resuProductssale);
        $Productssale = $objProductssale['Productssale'];
        // mkdir("../uploads/$FGName/$Pname[$MainArray]/");
        $targetDir = "../uploads/$FGName/$nameArray[$MainArray]/";
        $countimg = "SELECT ImageName FROM productpicture WHERE Productssale='$Productssale'";
        $resucountIMD= mysqli_query($conn, $countimg);
        while($IMGindata = mysqli_fetch_array($resucountIMD, MYSQLI_ASSOC)){
            $SubArray[] = $IMGindata['ImageName'];
        }
        // print_r($SubArray);
        $NumberofSubArray = count($SubArray)+1;
        // echo $NumberofSubArray; //ใช้ในการบอกว่าตอนนี้รูปเป็นรูปที่เท่าไหร่
        foreach($val as $K => $V ){
            $fileName = basename($_FILES['upload']['name'][$key][$K]); //ได้ชื่ออย่างเดียวไม่เอาเลยkey
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);//แยกนามสกุลไฟล์ออกมา
            $fileName = $Productssale."_$NumberofSubArray".".".$fileType;//เปลี่ยนชื่อไฟล์
            $targetFilePath = $targetDir . $fileName; //เอาชื่อ+ที่อยู่
            // echo $targetFilePath;
            // echo $NumberofSubArray;
            // echo "<br>";
            // Check whether file type is valid 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["upload"]["tmp_name"][$key][$K], $targetFilePath)){ 
                    // Image db insert sql 
                    $sqlIMG = "INSERT INTO productpicture (Productssale,ImageName)
                        VALUES ('$Productssale','$fileName')";
                        $result = mysqli_query($conn,$sqlIMG) or die("Error : ". mysqli_error($conn));
                }else{ 
                  echo "Sorry, there was an error uploading your file.";
                }
            }
            $NumberofSubArray++;
        } 
    }
    else {
        
    }
}   


?>
<script type="text/javascript">
  window.location.href = "../EditProductsSale.php?formID=<?php echo $FGID; ?>";
</script>