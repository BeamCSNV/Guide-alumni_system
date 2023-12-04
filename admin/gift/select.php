<?php
$gift_id  = $_POST['gift_id'];
include '../../config/conf.php';
$opt = '';
try {
  $sql = "SELECT * FROM gift WHERE gift_id='$gift_id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
 
      $opt.=' <div align="center"> <img src="upload_gift/'.$row->gift_image.'"width="320" height="480"></div>';
      $opt.='<br>';
      $opt.='<tr>
              <td><lable>รหัสของที่ระลึก</lable></td>
              <td>'.$row->gift_id.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>ชื่อ</lable></td>
              <td>'.$row->gift_name.'</td>
            </tr>';
      $opt.='<tr>
            <td><lable>ราคา</lable></td>
            <td>'.$row->gift_price.'</td>
          </tr>';
        $opt.='<tr>
          <td><lable>รายละเอียด</lable></td>
          <td>'.$row->gift_detail.'</td>
          </tr>';

}
    $opt.='</table></div>';
echo $opt;
 ?>