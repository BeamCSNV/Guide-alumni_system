<?php
include '../../config/conf.php';
$activity_id = $_POST['activity_id'];
echo $activity_id;
$sql = "DELETE FROM activity WHERE activity_id ='$activity_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>