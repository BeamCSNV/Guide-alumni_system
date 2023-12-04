
<?php
  $event_list_id = $_POST['event_list_id'];
  include '../../config/conf.php';
  try {
    $sql = "SELECT * FROM event_list WHERE event_list_id='$event_list_id'";
    $query = $conn->prepare($sql);
    $query ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
  $row=$query -> fetch(PDO::FETCH_OBJ);
  echo json_encode($row);
 ?>