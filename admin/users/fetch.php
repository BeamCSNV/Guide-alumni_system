<?php
  $user_id = $_POST['user_id'];
  include '../../config/conf.php';
  try {
    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>