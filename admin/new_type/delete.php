<?php
include '../../config/conf.php';
$new_type_id  = $_POST['new_type_id'];
echo $new_type_id ;
$sql = "DELETE FROM new_type WHERE new_type_id  ='$new_type_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>