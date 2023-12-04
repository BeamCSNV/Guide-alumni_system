<?php
$id  = $_POST['id'];
include '../../config/conf.php';
$opt = '';
try {
  $sql = "SELECT * FROM alumni WHERE id='$id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
     
      $opt.='<tr>
              <td><lable>รหัสนักศึกษา</lable></td>
              <td>'.$row->std_id .'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>ชื่อ-สกุล</lable></td>
              <td>'.$row->std_title_name.$row->std_name." - ".$row->std_lastname.'</td>
            </tr>';
      $opt.='<tr>
            <td><lable>เบอร์โทร</lable></td>
            <td>'.$row->std_phone.'</td>
          </tr>';
        $opt.='<tr>
          <td><lable>อีเมล์</lable></td>
          <td>'.$row->std_email.'</td>
          </tr>';
      $opt.='<tr>
          <td><lable>ที่อยู่</lable></td>
          <td>'.$row->std_address.'</td>
         </tr>';
      $opt.='<tr>
          <td><lable>ระดับการศึกษา</lable></td>
          <td>'.$row->prog_id.'</td>
          </tr>';
      $opt.='<tr>
         <td><lable>ปีที่เข้าเรียน</lable></td>
         <td>'.$row->std_year_start.'</td>
         </tr>';
      $opt.='<tr>
        <td><lable>ปีที่จบ</lable></td>
        <td>'.$row->std_year_complete.'</td>
        </tr>';
      $opt.='<tr>
       <td><lable>ชื่อบริษัท</lable></td>
       <td>'.$row->std_company.'</td>
       </tr>';
       $opt.='<tr>
       <td><lable>เบอร์บริษัท</lable></td>
       <td>'.$row->std_compamy_phone.'</td>
       </tr>';
       $opt.='<tr>
       <td><lable>ตำแหน่งงาน</lable></td>
       <td>'.$row->std_job_position.'</td>
       </tr>';
       $opt.='<tr>
       <td><lable> เงินเดือน (บาท)</lable></td>
       <td>'.$row->std_job_salary.'</td>
       </tr>';
}
    $opt.='</table></div>';
echo $opt;
 ?>