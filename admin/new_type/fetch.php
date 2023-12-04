<?php
  $new_type_id = $_POST['new_type_id'];
  include '../../config/conf.php';
  try {
    $sql = "SELECT * FROM new_type WHERE new_type_id='$new_type_id'";
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>