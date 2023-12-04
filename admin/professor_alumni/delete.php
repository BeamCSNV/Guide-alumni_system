<?php
include '../../config/conf.php';
$id  = $_POST['id'];
echo $id ;
$sql = "DELETE FROM alumni WHERE id  ='$id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>