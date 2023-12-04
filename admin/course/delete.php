<?php
include '../../config/conf.php';
$course_id = $_POST['course_id'];
echo $course_id;
$sql = "DELETE FROM course WHERE course_id ='$course_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>