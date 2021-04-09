<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function preview(filesimg) {
        var files = filesimg.files;
        oFiles = this.file;
        var filesAmount = files.length;
       const imgdiv = document.getElementById("img");
       imgdiv.innerHTML = "";
       console.log("เข้าฟังชั่น");
       console.log(filesAmount);
       for (let i = 0; i < filesAmount; i++) {
        console.log("ลูป");
        const img = document.createElement("img");
        img.src = URL.createObjectURL(files[i]);
        img.height = 60;
        img.width=60;
        imgdiv.appendChild(img);
       }
}
    </script>
</head>
<body>
<?php
    $FG = $_GET['formID'];
    $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
    $conn->set_charset("utf8");
    $sql ="SELECT * FROM farmergroup WHERE 	FGID='$FG'";
    $result = mysqli_query($conn,$sql) or die("Error : ". mysqli_error($conn));
    $objResult = mysqli_fetch_array($result);
    //print_r($result);
    $sqlimg = "SELECT * FROM groupphoto WHERE FGID='$FG'";
    $resultIMG = mysqli_query($conn,$sqlimg) or die("Error : ". mysqli_error($conn));
    // print_r($resultIMG);
    // print_r($objResultIMG);
?>
<form action="Process/EditGroup.php?FGID=<?php echo $_GET['formID']; ?>" method="post" enctype="multipart/form-data">
        <label for="">ชื่อกลุ่มเกษรกร</label>
        <input type="text" name="FGName" value="<?php echo $objResult['FGName']; ?>">
        <label for=>จำนวณเกษตรกร(ราย)</label>
        <input type="number" name="NumF" id="" value="<?php echo $objResult['NumF']; ?>">
        <label for="">พื้นที่</label>
        <input type="number" name="Area" id="" value="<?php echo $objResult['Area']; ?>">
        <label for="">ที่ตั้งกลุ่ม</label>
        <input type="text" name="FGLo" id="" value="<?php echo $objResult['FGLo']; ?>">
        <label for="">Latitude</label>
        <input type="number" name="Latitude" id="" value="<?php echo $objResult['Latitude']; ?>">
        <label for="">Longitude</label>
        <input type="number" name="Longitude" id="" value="<?php echo $objResult['Longitude']; ?>">
        <label for="">ประธานกลุ่ม</label>
        <input type="text" name="Gpresid" id="" value="<?php echo $objResult['Gpresid']; ?>">
        <label for="">เบอร์โทรศัพท์ประธานกลุ่ม</label>
        <input type="number" name="Phone " id="" value="<?php echo $objResult['Phone']; ?>">
        <label for="">Facebook</label>
        <input type="text" name="Facebook" id="" value="<?php echo $objResult['FaceBook']; ?>">
        <label for="">Instagram</label>
        <input type="text" name="Instagram" id="" value="<?php echo $objResult['Instagram']; ?>">
        <label for="">LINE</label>
        <input type="text" name="LINE" id="" value="<?php echo $objResult['LINE']; ?>">
        <label for="">Twitter</label>
        <input type="text" name="Twitter" id="" value="<?php echo $objResult['Twitter']; ?>">
        <label for="">เว็ปไซต์</label>
        <input type="text" name="Web" id="" value="<?php echo $objResult['Web']; ?>">
        <label for="">เบอร์ติดต่อ</label>
        <input type="number" name="PhoneG" id="" value="<?php echo $objResult['PhoneG']; ?>">
        <input type="file" multiple id="gallery-photo-add" name="files[]" onchange="preview(this)">
        <input type="submit" value="OK" name="submit">
        <div id="img">

        </div>
        </form>
        <table>
        <tr>
        <th>รูป</th>
        <th>ลบ</th>
        </tr>
        <?php
       $nameFloder= $objResult['FGName'];
       $base= "uploads/$nameFloder/";
        while ($rows = $resultIMG->fetch_array()) { ?>
        <tr>
            <td><img src="<?php echo $base.$rows["ImageName"];?>" alt="" width="10%" height="10%"></td>
            <td><a href="Process/deleteIMGgroup.php?SeriesID=<?php echo $rows["SeriesID"];?>&FGID=<?php echo $rows['FGID'];?>"><button>ลบ</button></a></td>
        </tr>
        <?php } ?>
        </table>
        
</body>
</html>