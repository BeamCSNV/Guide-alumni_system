
<?php
include '../../config/conf.php';
$activity_id  = $_POST['activity_id'];
$activity_name = $_POST['activity_name'];
$activity_new_id = sprintf("ACT")."-".date("ymdHis")."-".rand(0,9999);
if ($activity_id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE activity SET activity_name = :activity_name WHERE activity_id = :activity_id');
  $result = $query->execute([
    'activity_name'=>$activity_name,
    'activity_id' => $activity_id
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO activity(activity_id, activity_name) VALUES(:activity_id, :activity_name)');
  $result = $query->execute(array(
                      'activity_id' => $activity_new_id,
                      'activity_name' => $activity_name,
                     
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>
