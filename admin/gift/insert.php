<?php
include '../../config/conf.php';
$gift_id  = $_POST['gift_id'];
$gift_name = $_POST['gift_name'];
$gift_price = $_POST['gift_price'];
$gift_detail = $_POST['gift_detail'];
$gift_image = $_POST['gift_image'];

$gift_new_id = sprintf("GF")."-".date("ymdHis")."-".rand(0,9999);
if ($gift_id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE gift SET gift_name = :gift_name, gift_detail = :gift_detail, gift_price = :gift_price, gift_image = :gift_image WHERE gift_id = :gift_id');
  $result = $query->execute([
    'gift_name' => $gift_name,
    'gift_detail' => $gift_detail,
    'gift_price' => $gift_price,
    'gift_image' => $gift_image,
    'gift_id' => $gift_id,
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO gift(gift_id, gift_name, gift_detail, gift_price, gift_image) VALUES(:gift_id, :gift_name, :gift_detail, :gift_price, :gift_image)');
  $result = $query->execute(array(
                      'gift_id' => $gift_new_id,
                      'gift_name' => $gift_name,
                      'gift_detail' => $gift_detail,
                      'gift_price' => $gift_price,
                      'gift_image' => $gift_image
                     
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>