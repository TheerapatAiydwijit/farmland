<?php
    $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
    $conn->set_charset("utf8");
    $sqlProdu = "SELECT * FROM product ORDER BY PID";
    $resultProdu = mysqli_query($conn, $sqlProdu);
    $formID=$_GET['formID'];
    $sqlproductSale = "SELECT * FROM productssale WHERE FGID='$formID'";
    $resultproductSale = mysqli_query($conn,$sqlproductSale);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .visually-hidden {
  clip: rect(0 0 0 0);
  clip-path: inset(50%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.form-popup {
  display: none;
  position: fixed;
  border: 3px solid #f1f1f1;
  z-index: 9;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 50%;
  background-color: #fefefe;
}
.container {
  position: relative;
  width: 50%;
  max-width: 50px;
}

.container img {
  width: 50%;
  height: auto;
}

.container .btn {
  /* position: absolute; */
  top: 10%;
  left: 85%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 1px 1px;
  border: none;
  cursor: pointer;
  border-radius: 100px;
  text-align: center;
}

.container .btn:hover {
  background-color: black;
  }
    </style>
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
$(document).ready(function(){
    $("#myTable tr").hide();
  $("#tableSearch").on("keypress", function() {
    $("#myTable tr").show();
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
var targetpopup =1 ;
    $(document).ready(function(){
        $('#myTable2').on('click', '.delect', function() {
   $(this).parents('tr').remove();  
  });
});

function CreateAProductList(PID,Pname,Type){
  table = document.getElementById("myTable2");
  var number = table.rows.length;
  var PIDget = PID;
  var PNameget = Pname;
  var Type = Type;
  var Ntarget = targetpopup;
  console.log(PID,Pname);
  console.log(Type);
  ordernumber =number +1;
  var row = table.insertRow(number);

  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);
  var cell8 = row.insertCell(7);
  var cell9 = row.insertCell(8);
  var cell10 = row.insertCell(9);
  var cell11 = row.insertCell(10);
  var cell12 = row.insertCell(11);

  var PID = document.createElement('input');
  PID.name = 'PID[]';
  PID.type = 'text';
  PID.setAttribute("Class","visually-hidden")
  //<input class="form-control" id="anythingSearch" type="text" placeholder="Type something to search list items">
  var Pname = document.createElement('input');
  Pname.type = 'text';
  Pname.name = 'Pname[]';
  var PVolume = document.createElement('input');
  PVolume.type = 'text';
  PVolume.name = 'PVolume[]';
  PVolume.class = "PVolume";
  var PCycle = document.createElement('input');
  PCycle.type = 'text';
  PCycle.name = 'PCycle[]';
  PCycle.class = "PCycle";
  var Ptime = document.createElement('input');
  Ptime.type = 'text';
  Ptime.name = 'Ptime[]';
  Ptime.class = "Ptime";
  var price = document.createElement('input');
  price.type = 'text';
  price.name = 'price[]';
  price.class = "price";
  var Unit = document.createElement('SELECT');
  Unit.name = 'Unit[]';
  Unit.class = "Unit";
  var Units = ["กิโลกรัม","ชิ้น","ตัว"];
  for(var x=0;x<Units.length;x++){
      var Option = document.createElement("option");
      Option.setAttribute("value",Units[x]);
      var text = document.createTextNode(Units[x]);
      Option.appendChild(text);
      Unit.appendChild(Option);
  }
//
var items = ["ไม่มี","มี"];
  var standard_Q = document.createElement('SELECT');
  standard_Q.name = 'standard_Q[]';
  for(var i = 0;i<items.length;i++) {
    var item = items[i];
    var newOption = document.createElement("option");
    newOption.setAttribute("value", item);
    var textNode = document.createTextNode(item);
    newOption.appendChild(textNode);
    standard_Q.appendChild(newOption);
  }
  var standard_GAP = document.createElement('SELECT');
  standard_GAP.name = 'standard_GAP[]';
  for(var i = 0;i<items.length;i++) {
    var item = items[i];
    var newOption = document.createElement("option");
    newOption.setAttribute("value", item);
    var textNode = document.createTextNode(item);
    newOption.appendChild(textNode);
    standard_GAP.appendChild(newOption);
  }
  var standard_GMP = document.createElement('SELECT');
  standard_GMP.name = 'standard_GMP[]';
  for(var i = 0;i<items.length;i++) {
    var item = items[i];
    var newOption = document.createElement("option");
    newOption.setAttribute("value", item);
    var textNode = document.createTextNode(item);
    newOption.appendChild(textNode);
    standard_GMP.appendChild(newOption);
  }
//อัฟไฟล์
var divf = document.createElement('div');
divf.setAttribute("Class","form-popup");
divf.setAttribute("ID",ordernumber);
//ส่วนนี้เอาTEXTมาบวกกันเพื่อสร้างตัวแปรของชื่อ เอาไว้ใส่ในfile name=upload[ค่าi][]
var nametoset = "upload";
var brac = '[';
var ket = ']';
var bracket = '[]';
var upload = "upload"
var bracketi = brac+ordernumber+ket;
var pluename = upload+bracketi+bracket;// upload + [i] + []
//
//
var divshowIMG = document.createElement('div')
divshowIMG.setAttribute("ID",pluename);
//
var file = document.createElement('input')
file.type='file';
file.setAttribute("multiple","multiple");
file.name = pluename;
file.addEventListener("change",function(){
  preview(this.name,this);
},false);
//

//
var openForm = document.createElement('button');
openForm.innerHTML = 'openForm';
openForm.name = number+1;
openForm.type = 'button';
openForm.addEventListener("click",function(){
  OpenForm(this.name);
}, false);

var closeForm = document.createElement('button');
closeForm.innerHTML = 'closeForm';
closeForm.name = number+1;
closeForm.type = 'button';
closeForm.addEventListener("click",function(){
  CloseForm(this.name);
}, false);
//
  var buttondelect = document.createElement('button');
  buttondelect.innerHTML = 'ลบ';
  buttondelect.type = 'button';
  buttondelect.name = 'dele';
  buttondelect.class = "form";
  buttondelect.className ="delect";


  if(Type==1){
        PID.setAttribute("value",PIDget);
        Pname.setAttribute("value",PNameget);
        //PID.style.display = 'none';
        PID.setAttribute("readonly","readonly");
        Pname.setAttribute("readonly","readonly");
  }
  if(Type==2){
        PID.setAttribute("value",PIDget);
        //PID.style.display = 'none';
        PID.setAttribute("readonly","readonly");
  }
  divf.appendChild(file);
  divf.appendChild(divshowIMG);
  divf.appendChild(closeForm);
  
  cell1.appendChild(PID);
  cell2.appendChild(Pname);
  cell3.appendChild(PVolume);
  cell4.appendChild(PCycle);
  cell5.appendChild(Ptime);
  cell6.appendChild(price);
  cell7.appendChild(Unit);
  cell8.appendChild(standard_Q);
  cell9.appendChild(standard_GAP);
  cell10.appendChild(standard_GMP);
  cell11.appendChild(openForm);
  cell12.appendChild(buttondelect);
  row.appendChild(divf);
  targetpopup++
}
//เปิดปิดpopup
function OpenForm(target) {
                console.log(target);
              document.getElementById(target).style.display = "block";
            }
function CloseForm(target) {
                console.log(target);
              document.getElementById(target).style.display = "none";
            }
function preview(nameIMG,filesimg) {
  console.log(nameIMG);
  // fname = '"'+nameIMG+'"';
        var files = filesimg.files;
        oFiles = this.file;
        var filesAmount = files.length;
        const imgdiv = document.getElementById(nameIMG);
      //  const imgdiv = document.getElementsByClassName(name);
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
<form action="Process/editProductsSale.php?formID=<?php echo $formID; ?>" method="post" enctype="multipart/form-data">
<div class="container">
  <input class="form-control mb-4" id="tableSearch" type="text"
    placeholder="Type something to search list items">

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>ชื่อ</th>
        <th>ใส่รายละเอียด</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php
    while ($row =$resultProdu->fetch_array()) { ?>
    <tr>
      <td><?php echo $row['PID']; ?></td>
      <td><?php echo $row['Pname']; ?></td>
      <td><a href="#" onclick="CreateAProductList('<?php echo $row['PID']; ?>','<?php echo $row['Pname']; ?>', '1')" > เลือก</a></td>
      </tr>
    <?php } ?>
    </tbody>
    <tr>
      <td  colspan="3"><center><a href="#" onclick="CreateAProductList('0','0','2')" >เพิ่มสินค้าใหม่</a></center></td>
    </tr>
  </table>
</div>
<table>
<thead>
  <tr>
          <th class="visually-hidden">รหัสสินค้า</th>
          <th>ชื่อสินค้า</th>
          <th>ปริมาณผลผลิต</th>
          <th>รอบการผลิต</th>
          <th>ช่วงเวลาผลผลิตออกสู่ตลาด</th>
          <th>ราคา</th>
          <th>หน่วยราคา</th>
          <th>มาตรฐาน Q</th>
          <th>มาตรฐาน GAP</th>
          <th>มาตรฐาน GMP</th>
          <th>รูปภาพ</th>
          <th>ลบ</th>
      </tr>
    </thead>
    <tbody id="myTable2">
<?php $order = 1;
    while($rowP = $resultproductSale->fetch_array()){?>
        <tr>
            <td class="visually-hidden"><input type="text" value=" <?php echo $rowP['PID']; ?>" name="PID[]"></td>
            <td><input type="text" value=" <?php 
                  $PID =$rowP['PID'];
                  $sqlP = "SELECT Pname FROM product WHERE PID=$PID";
                  $resultprodut = mysqli_query($conn, $sqlP);
                  $produt =mysqli_fetch_array($resultprodut);
            echo $produt['Pname']; ?>" name="Pname[]"></td>
            <td><input type="text" value=" <?php echo $rowP['PVolume']; ?>" name="PVolume[]"></td>
            <td><input type="text" value=" <?php echo $rowP['PCycle']; ?>" name="PCycle[]"></td>
            <td><input type="text" value=" <?php echo $rowP['Ptime']; ?>" name="Ptime[]"></td>
            <td><input type="text" value=" <?php echo $rowP['Price']; ?>" name="price[]"></td>
            <!-- <td><input type="text" value=" <?php echo $rowP['Unit']; ?>" name="Unit[]"></td> -->
            <!-- <select name="Unit[]"> -->
            <td>
            <?php 
              if($rowP['Unit']==="กิโลกรัม"){
                  echo '<select name="Unit[]"> 
                  <option value="กิโลกรัม" selected>กิโลกรัม</option>
                  <option value="ชิ้น">ชิ้น</option>
                  <option value="ตัว">ตัว</option> 
                  </select>';
              }
              elseif($rowP['Unit']==="ชิ้น"){
                echo '<select name="Unit[]"> 
                  <option value="กิโลกรัม">กิโลกรัม</option>
                  <option value="ชิ้น" selected>ชิ้น</option>
                  <option value="ตัว">ตัว</option>
                  </select>';
              }
              else {
                echo '<select name="Unit[]"> 
                <option value="กิโลกรัม">กิโลกรัม</option>
                <option value="ชิ้น">ชิ้น</option>
                <option value="ตัว" selected>ตัว</option>
                </select>';
              } 
            ?>
            </td>
            <td> <?php if($rowP['standard_Q']==0) { ?>
                  <select name="standard_Q[]">
                  <option value="ไม่มี" selected>ไม่มี</option>
                  <option value="มี">มี</option>
                  </select>
            <?php }else{ ?>
              <select name="standard_Q[]">
                  <option value="ไม่มี">ไม่มี</option>
                  <option value="มี" selected>มี</option>
                  </select>
           <?php } ?>
            </td>
            <td> <?php if($rowP['standard_GAP']==0) { ?>
                  <select name="standard_GAP[]">
                  <option value="ไม่มี" selected>ไม่มี</option>
                  <option value="มี">มี</option>
                  </select>
            <?php }else{ ?>
              <select name="standard_GAP[]">
                  <option value="ไม่มี">ไม่มี</option>
                  <option value="มี" selected>มี</option>
                  </select>
           <?php } ?>
            </td>
            <td> <?php if($rowP['standard_GMP']==0) { ?>
                  <select name="standard_GMP[]">
                  <option value="ไม่มี" selected>ไม่มี</option>
                  <option value="มี">มี</option>
                  </select>
            <?php }else{ ?>
              <select name="standard_GMP[]">
                  <option value="ไม่มี">ไม่มี</option>
                  <option value="มี" selected>มี</option>
                  </select>
           <?php } ?>
            </td>
            <td>
             <button type="button" onclick="OpenForm(this.name)" name="<?php echo $order; ?>">OpenForm</button>
             <div class="form-popup" ID="<?php echo $order; ?>">
             <input type="file" multiple name="<?php 
             $nametoset = "upload";
             $brac = '[';
             $ket = ']';
             $bracket = '[]';
             $upload = "upload";
             $bracketi = $brac.$order.$ket;
             $pluename = $upload.$bracketi.$bracket;// upload + [i] + []
             echo $pluename; ?>" onchange="preview(this.name,this);" value="<?php echo $pluename; ?>">
            <div ID="<?php echo $pluename; ?>">

            </div>
<!-- อันนี้ไว้โชรูปที่มีอยู่แล้ว -->
          <div>
            <h5>รูปที่มีอยู่ในระบบแล้ว</h5>
            <?php 
            $key =  $rowP['Productssale'];
            $select = "SELECT * FROM productpicture WHERE Productssale=$key";
            $resultprodutIMG = mysqli_query($conn, $select);
            $selectnamegroup = "SELECT * FROM farmergroup WHERE FGID=$formID";
            $resultgropname = mysqli_query($conn, $selectnamegroup);
            $gname = mysqli_fetch_array($resultgropname);
            $namegrop = $gname['FGName'];
              // $teste = $row['PID']===$rowP['PID'];
            // print $rowP['PID'] == 1 ? $produt['Pname']: "false"; // true
            while($ojt = $resultprodutIMG->fetch_array()){ 
                $nameproduct =  $produt['Pname'];
                $nameIMG = $ojt['ImageName'];
                $target = "uploads/$namegrop/$nameproduct/$nameIMG";
                // echo $target;
              ?>
                  <div class="container" style="display: inline">
                  <img src="<?php echo $target; ?>" alt="product" style="width:10%">
                   <a href="Process/deleteIMGproduct.php?IMGname=<?php echo $target; ?>&formID=<?php echo $formID;?>"><button class="btn" type="button">ลบ</button></a>
              </div>
            <?php }?>
          </div>
          <button type="button" name="<?php echo $order; ?>" onclick="CloseForm(this.name);">closeForm</button>
            </div>
            </td>
            <td>
              <a href="Process/DelectProductsSale.php?Productssale=<?php echo $rowP['Productssale']; ?>">
              <input type="button" value="ลบ" class="delectEdit">
              </a>
            </td>
        </tr>

   <?php $order++; } ?>
</tbody>
  </table>
  <input type="submit" value="Submit">
  </form>
</body>
</html>