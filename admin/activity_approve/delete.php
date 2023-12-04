<?php
include '../../config/conf.php';
$id = $_POST['id'];
echo $id;
$sql = "DELETE FROM activity_register WHERE id ='$id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>