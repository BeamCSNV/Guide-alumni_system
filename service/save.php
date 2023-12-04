<?php
include '../config/conf.php';
$alumni_id  = $_POST['alumni_id'];
echo $alumni_id ;
$state_good = "ศิษย์เก่าดีเด่น";
if ($alumni_id!='') {
    echo "UPDATE";
    $query = $conn->prepare('UPDATE alumni SET state_good = :state_good WHERE alumni_id = :alumni_id');
    $result = $query->execute([
      'state_good'=>$state_good,
      'alumni_id' => $alumni_id
    ]);

if ($result) {
    echo "success";
}else {
    echo "error";
    }
}
?>