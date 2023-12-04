<?php
  $gift_id = $_POST['gift_id'];
  include '../../config/conf.php';
  try {
    $sql = "SELECT * FROM gift WHERE gift_id='$gift_id'";
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>