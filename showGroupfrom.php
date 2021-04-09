<?php
 $conn= mysqli_connect("localhost","root","","farmland") or die("Error: " . mysqli_error($conn));
 $conn->set_charset("utf8");
 $perpage = 10;
 if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
 $start = ($page - 1) * $perpage;
 $strSQL = "SELECT * FROM farmergroup ORDER BY FGID DESC limit {$start} , {$perpage}";
 $result = mysqli_query($conn, $strSQL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table width="600" border="1">
    <tr>
    <th width="30"> <div align="center">order </div></th>
    <th width="91"> <div align="center">FGID  </div></th>
    <th width="98"> <div align="center">FGName  </div></th>
    <th width="198"> <div align="center">NumF </div></th>
    <th width="97"> <div align="center">FGLo </div></th>
    <th width="59"> <div align="center">Gpresid </div></th>
    <th width="30"> <div align="center">Edit </div></th>
    <th width="30"> <div align="center">EditProduct</div></th>
    <th width="71"> <div align="center">delect</div></th>
  </tr>
  <?php
  $i =1;
while ($row = $result->fetch_array()) { ?>
  <tr>
  <td><?php echo $i++ ?> </td>
  <td><?php echo $row["FGID"] ?> </td>
  <td><?php echo $row["FGName"] ?> </td>
  <td><?php echo $row["NumF"] ?> </td>
  <td><?php echo $row["FGLo"] ?></td>
  <td><?php echo $row["Gpresid"] ?> </td>
<td> <a href="EditGroupFrom.php?formID=<?php echo $row['FGID'];?>">Edit</a></td>
<td> <a href="EditProductsSale.php?formID=<?php echo $row['FGID'];?>">EditProduct</a></td>
<td> <a href="Process/Delect.php?formID=<?php echo $row['FGID'];?>">Delete</a></td>
</tr>
<?php } ?>
</table>
<?php
 $sql2 = "SELECT * FROM farmergroup";;
 $query2 = mysqli_query($conn, $sql2);
 $total_record = mysqli_num_rows($query2);
 $total_page = ceil($total_record / $perpage);
 ?>
 <ul class="page" style="list-style: none;">
   <li style="display:inline-block;">
   <a href="showGroupfrom.php?page=1"><<</a>
   </li>
    <?php for($i=1;$i<=$total_page;$i++){  ?>
    <li style="display:inline-block;"><a href="showGroupfrom.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <li style="display:inline-block;">
 <a href="showGroupfrom.php?page=<?php echo $total_page;?>" aria-label="Next">>></a></li>
   </ul>
</body>
</html>