
<?php
include '../../config/conf.php';
$course_id  = $_POST['course_id'];
$course_name = $_POST['course_name'];
$course_new_id = sprintf("CS")."-".date("ymdHis")."-".rand(0,9999);
if ($course_id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE course SET course_name = :course_name WHERE course_id = :course_id');
  $result = $query->execute([
    'course_name'=>$course_name,
    'course_id' => $course_id
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO course(course_id, course_name) VALUES(:course_id, :course_name)');
  $result = $query->execute(array(
                      'course_id' => $course_new_id,
                      'course_name' => $course_name,
                     
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>
