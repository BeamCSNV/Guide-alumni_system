<?php
$user_id  = $_POST['user_id'];
include '../../config/conf.php';
$opt = '';
try {
  $sql = "SELECT * FROM users WHERE user_id='$user_id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
     
      $opt.='<tr>
              <td><lable>รหัส</lable></td>
              <td>'.$row->user_id.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>ชื่อ</lable></td>
              <td>'.$row->user_name.'</td>
            </tr>';
      $opt.='<tr>
            <td><lable>เบอร์โทร</lable></td>
            <td>'.$row->user_phone.'</td>
           </tr>';
      $opt.='<tr>
           <td><lable>สถานะ</lable></td>
           <td>'.$row->user_status.'</td>
          </tr>';
      $opt.='<tr>
            <td><lable>อีเมล</lable></td>
            <td>'.$row->user_email.'</td>
          </tr>';
        $opt.='<tr>
          <td><lable>รหัสผ่าน</lable></td>
          <td>***********</td>
          </tr>';
}
    $opt.='</table></div>';
echo $opt;
 ?>