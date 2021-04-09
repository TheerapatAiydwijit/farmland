<?php
$test1 = (isset($_POST['test1'])?'1':'0');
$test2 = (isset($_POST['test2'])?'1':'0');
$test2 = (isset($_POST['test2'])?'1':'0');
    echo $test1;
    echo "<br>";
    echo $test2;






//     $conn =mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
//     $FGID = $_GET['FGID'];
//     $strSQL = "SELECT * FROM groupphoto WHERE FGID='$FGID'";
//     $result = mysqli_query($conn,$strSQL) or die("Error : ". mysqli_error($conn));
//     // $IMGCount = count($objResult['ImageName']);
//     // echo $IMGCount;
//     // print_r($objResult['ImageName']);
//     $substring = "";
//     while ($rows = $result->fetch_array()) {
//         echo $rows['ImageName'];
//         echo "<br>";
//         $substring = $rows['ImageName']; 
//     }
//     echo $substring;
//    $substring = substr("$substring",12,1);
//    echo $substring+1;

?>