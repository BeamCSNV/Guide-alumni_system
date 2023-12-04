<?php
$new_type_id  = $_POST['new_type_id'];
include '../../config/conf.php';
$opt = '';
try {
  $sql = "SELECT * FROM new_type WHERE new_type_id='$new_type_id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
     
      $opt.='<tr>
              <td><lable>รหัสประเภทข่าวสาร</lable></td>
              <td>'.$row->new_type_id.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>ประเภทข่าวสาร</lable></td>
              <td>'.$row->new_type_name.'</td>
            </tr>';
}
    $opt.='</table></div>';
echo $opt;
 ?>
