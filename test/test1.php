<?php
    $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
    $sqlProdu = "SELECT * FROM product ORDER BY PID";
    $resultProdu = mysqli_query($conn, $sqlProdu);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
function myFunction(PID,Pname){
  table = document.getElementById("myTable2");
  var number = table.rows.length;
  var PIDget = PID;
  var PNameget = Pname;
  console.log(PID,Pname);
  var row = table.insertRow(number);

  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  
  var PID = document.createElement('input');
  //PID.type = 'text';
  PID.name = 'PID[]';
  PID.setAttribute("value",PIDget);
  PID.setAttribute("disabled","disabled");
  //<input class="form-control" id="anythingSearch" type="text" placeholder="Type something to search list items">
  var Pname = document.createElement('input');
  Pname.type = 'text';
  Pname.name = 'Pname[]';
  Pname.setAttribute("value",PNameget);
  Pname.setAttribute("disabled","disabled");
  var PCycle = document.createElement('input');
  PCycle.type = 'text';
  PCycle.name = 'PCycle[]';
  PCycle.class = "PCycle";
  cell1.appendChild(PID);
  cell2.appendChild(Pname);
  cell3.appendChild(PCycle);
}
    </script>
</head>
<body>
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
      <td><a href="#" onclick="myFunction(<?php echo $row['PID']; ?>,'<?php echo $row['Pname']; ?>')"> เลือก</a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
<table>
<thead>
      <tr>
      <th>รหัส</th>
        <th>ชื่อ</th>
        <th>ชนิด</th>
      </tr>
    </thead>
    <tbody id="myTable2">

</tbody>
  </table>
</body>
</html>