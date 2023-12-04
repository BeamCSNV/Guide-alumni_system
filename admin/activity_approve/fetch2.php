<?php
  $id = $_POST['id'];
  $status = $_POST['status'];
  include '../../config/conf.php';
  // echo  $id;
  try {
  
    $sql = "UPDATE `activity_register` SET `status` = '$status' WHERE `id` = '$id'";
    // echo  $sql;
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>