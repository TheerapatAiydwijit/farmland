<?php
$fileNames = array_filter($_FILES['files']['name']); 
print_r($fileNames);
?>