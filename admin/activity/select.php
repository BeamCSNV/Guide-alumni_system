<?php
$activity_id  = $_POST['activity_id'];
include '../../config/conf.php';
$opt = '';
try {
  $sql = "SELECT * FROM activity WHERE activity_id='$activity_id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
     
      $opt.='<tr>
              <td><lable>รหัสกิจกรรม</lable></td>
              <td>'.$row->activity_id.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>กิจกรรม</lable></td>
              <td>'.$row->activity_name.'</td>
            </tr>';
}
    $opt.='</table></div>';
echo $opt;
 ?>
