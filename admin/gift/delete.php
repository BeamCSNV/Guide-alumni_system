<?php
include '../../config/conf.php';
$gift_id  = $_POST['gift_id'];
echo $gift_id ;
$sql = "DELETE FROM gift WHERE gift_id  ='$gift_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>