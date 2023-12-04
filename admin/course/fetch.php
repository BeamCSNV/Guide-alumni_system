<?php
  $course_id = $_POST['course_id'];
  include '../../config/conf.php';
  try {
    $sql = "SELECT * FROM course WHERE course_id='$course_id'";
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>