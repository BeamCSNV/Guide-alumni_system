<?php
include '../../config/conf.php';
$event_list_id = $_POST['event_list_id'];
echo $event_list_id;
$sql = "DELETE FROM event_list WHERE event_list_id ='$event_list_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>