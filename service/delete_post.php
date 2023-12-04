
<?php
include '../config/conf.php';
$news_post_id = $_POST['news_post_id'];
echo $news_post_id;
$sql = "DELETE FROM news_post WHERE news_post_id ='$news_post_id'";
echo $sql;
$query = $conn->prepare($sql);
$query ->execute();
?>