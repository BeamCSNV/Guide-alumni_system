<?php
include '../../config/conf.php';
$user_id  = $_POST['user_id'];
echo $user_id ;
$sql = "DELETE FROM users WHERE user_id  ='$user_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>