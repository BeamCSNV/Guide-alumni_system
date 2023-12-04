<?php

$email = $_POST['email'];
$pass = $_POST['pass'];
include '../config/conf.php';
//***********************************ผู้ใช้งาน*******************************************

try {
    $sql = "SELECT * FROM users WHERE user_email ='".$email."' AND user_pass ='".$pass."' ";
    @$users = $conn->prepare($sql);
    @$users ->execute();
  } catch (\Exception $e) {
    // echo "ไม่สามารถพบข้อมูลได้";
  }
  
  //***********************************อาจาร์ยและศิษย์เก่า**********************************
  try {
    $sql2 = "SELECT * FROM alumni WHERE std_email ='".$email."' AND std_password ='".$pass."' AND state ='1' ";
    @$alumnis = $conn->prepare($sql2);
    @$alumnis ->execute();
  } catch (\Exception $e) {
    // echo "ไม่สามารถพบข้อมูลได้";
  }
  
  //***********************************************************************************
  if (@$users->rowCount()>0) {
    while ($data = $users -> fetch(PDO::FETCH_OBJ)) {
        $_SESSION['use_state']=$data->user_status;
        $_SESSION['use_name']=$data->user_name;
        $_SESSION['use_email']=$data->user_email;
        $_SESSION['use_id']=$data->user_id;
        }
    include '../service/load_login.html';
    }else if (@$alumnis->rowCount()>0) {
        while ($data = $alumnis -> fetch(PDO::FETCH_OBJ)) {
          $_SESSION['use_state']=$data->state;
          $_SESSION['use_name']=$data->std_name;
          $_SESSION['use_email']=$data->std_email;
          $_SESSION['use_id']=$data->id;
          
        }
    include '../service/load_login.html';
    }else{
        $_SESSION['messagelog']= "ล็อคอินไม่ได้รหัสหรือพาสเวิร์ดไม่ถุกต้อง";
        include '../service/load_login_error.html';
    }
   

?>