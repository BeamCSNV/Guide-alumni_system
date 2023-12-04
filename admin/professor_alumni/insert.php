<?php
include '../../config/conf.php';


@$id  = $_POST['id'];
$std_id = $_POST['std_id'];
$std_password = $_POST['std_password'];
$std_title_name = $_POST['std_title_name'];
$std_name = $_POST['std_name'];
$std_lastname = $_POST['std_lastname'];
$std_phone = $_POST['std_phone'];
$std_email = $_POST['std_email'];
$std_address = $_POST['std_address'];
$prog_id = $_POST['prog_id'];
$std_year_start = $_POST['std_year_start'];
$std_year_complete = $_POST['std_year_complete'];
$std_company = $_POST['std_company'];
$std_compamy_phone = $_POST['std_compamy_phone'];
$std_job_position = $_POST['std_job_position'];
$std_job_salary = $_POST['std_job_salary'];
$form_index = $_POST['form_index'];

// echo $id .'<br>';
// echo $std_id .'<br>';
// echo $std_password .'<br>';
// echo $std_title_name .'<br>';
// echo $std_name .'<br>';
// echo $std_lastname .'<br>';
// echo $std_phone .'<br>';
// echo $std_email .'<br>';
// echo $std_address .'<br>';
// echo $prog_id .'<br>';
// echo $std_year_start.'<br>' ;
// echo $std_year_complete .'<br>';
// echo $std_company .'<br>';
// echo $std_compamy_phone .'<br>';
// echo $std_job_position .'<br>';
// echo $std_job_salary .'<br>';\
$sql ="";
if ($id != '') {
  // echo "update";
  $sql = "UPDATE alumni SET std_id = '$std_id', std_password = '$std_password', std_title_name = '$std_title_name', std_name ='$std_name', std_lastname = '$std_lastname', std_phone = '$std_phone', std_email = '$std_email', std_address = '$std_address', prog_id = '$prog_id', std_year_start = '$std_year_start', std_year_complete = '$std_year_complete', std_company = '$std_company', std_compamy_phone = '$std_compamy_phone', std_job_position = '$std_job_position', std_job_salary =' $std_job_salary' WHERE id = '$id'";
  $query = $conn->prepare($sql);
  $query ->execute();
  // echo $sql ;
} else {
  // echo "insert";
  $sql = "INSERT INTO alumni(std_id, std_password, std_title_name, std_name, std_lastname, std_phone, std_email, std_address, prog_id, std_year_start, std_year_complete, std_company, std_compamy_phone, std_job_salary ) VALUES( '$std_id', '$std_password', '$std_title_name', '$std_name', '$std_lastname', '$std_phone', '$std_email', '$std_address', '$prog_id', '$std_year_start', '$std_year_complete', '$std_company', '$std_job_position', '$std_job_salary')";
  // echo $sql ;
  $query = $conn->prepare($sql);
  $query ->execute();
  if ($form_index) {
    // echo "มาจาก หน้าแรก";
    include '../../service/load.html';
  }
}
