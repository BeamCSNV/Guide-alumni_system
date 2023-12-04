<?php
$course_id  = $_POST['course_id'];
include '../../config/conf.php';
$opt = '';
try {
  $sql = "SELECT * FROM course WHERE course_id='$course_id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
     
      $opt.='<tr>
              <td><lable>รหัสหลักสูตร</lable></td>
              <td>'.$row->course_id.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>หลักสูตร</lable></td>
              <td>'.$row->course_name.'</td>
            </tr>';
}
    $opt.='</table></div>';
echo $opt;
 ?>
