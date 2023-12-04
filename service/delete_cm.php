
<?php
include '../config/conf.php';
$com_post_id = $_POST['com_post_id'];
echo $com_post_id;
$sql = "DELETE FROM comment_post WHERE com_post_id ='$com_post_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>