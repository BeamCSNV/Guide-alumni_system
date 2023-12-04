<?php
include '../../config/conf.php';
$user_id  = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_pass = $_POST['user_pass'];
$user_phone = $_POST['user_phone'];
$user_status = "อาจารย์";
$new_id = sprintf("U")."-".date("ymdHis")."-".rand(0,9999);
if ($user_id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE users SET user_name = :user_name, user_email = :user_email, user_pass = :user_pass, user_phone = :user_phone, user_status = :user_status WHERE user_id = :user_id');
  $result = $query->execute([
    'user_name' => $user_name,
    'user_email' => $user_email,
    'user_pass' => $user_pass,
    'user_phone' => $user_phone,
    'user_status' => $user_status,
    'user_id' => $user_id,
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO users(user_id, user_name, user_email, user_pass, user_phone, user_status) VALUES(:user_id, :user_name, :user_email, :user_pass, :user_phone, :user_status)');
  $result = $query->execute(array(
                      'user_id' => $new_id,
                      'user_name' => $user_name,
                      'user_email' => $user_email,
                      'user_pass' => $user_pass,
                      'user_phone' => $user_phone,
                      'user_status' => $user_status,
                     
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>