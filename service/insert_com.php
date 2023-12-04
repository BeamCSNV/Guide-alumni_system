<?php
include '../config/conf.php';
echo $com_post_id = $_POST['com_post_id'];
echo '<br>';
echo $com_post_user = $_POST['com_user'];
echo '<br>';
echo $com_post_user_state = $_POST['com_state'];
echo '<br>';
echo $news_post_id = $_POST['news_post_id'];
echo '<br>';
echo $com_post_detail = $_POST['com_post_detail'];
echo '<br>';
$new_id = date("ymdHis").rand(0,9999);
if ($com_post_id!='') {
  echo "UPDATE";
  echo $id = intval($com_post_id);
  $query = $conn->prepare("UPDATE comment_post SET com_post_detail = :com_post_detail WHERE com_post_id = :com_post_id");
  $result = $query->execute([
    'com_post_detail' => $com_post_detail,
     'com_post_id' => $id,
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO comment_post(com_post_id, com_post_detail, com_post_user, news_post_id, com_post_user_state) VALUES(:com_post_id, :com_post_detail, :com_post_user, :news_post_id, :com_post_user_state)');
  $result = $query->execute(array(
    'com_post_id' => $new_id,
    'com_post_user' => trim($com_post_user),
    'com_post_user_state' => $com_post_user_state,
    'news_post_id' => $news_post_id,
    'com_post_detail' => $com_post_detail
                     
                    ));
}
// if ($result) {
//   echo "success";
// }else {
//   echo "error";
// }

?>

