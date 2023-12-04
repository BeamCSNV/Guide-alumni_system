<?php
include '../../config/conf.php';
$id  = $_POST['id'];
echo $id ;
$state = 1;
if ($id!='') {
    echo "UPDATE";
    $query = $conn->prepare('UPDATE alumni SET state = :state WHERE id = :id');
    $result = $query->execute([
      'state'=>$state,
      'id' => $id
    ]);

if ($result) {
    echo "success";
}else {
    echo "error";
    }
}
?>