<?php
  $activity_id = $_POST['activity_id'];
  include '../../config/conf.php';
  try {
    $sql = "SELECT * FROM activity WHERE activity_id='$activity_id'";
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>