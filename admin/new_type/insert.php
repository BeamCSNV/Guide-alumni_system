
<?php
include '../../config/conf.php';
$new_type_id  = $_POST['new_type_id'];
$new_type_name = $_POST['new_type_name'];
$new_type_new_id = sprintf("NT")."-".date("ymdHis")."-".rand(0,9999);
if ($new_type_id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE new_type SET new_type_name = :new_type_name WHERE new_type_id = :new_type_id');
  $result = $query->execute([
    'new_type_name'=>$new_type_name,
    'new_type_id' => $new_type_id
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO new_type(new_type_id, new_type_name) VALUES(:new_type_id, :new_type_name)');
  $result = $query->execute(array(
                      'new_type_id' => $new_type_new_id,
                      'new_type_name' => $new_type_name,
                     
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>
