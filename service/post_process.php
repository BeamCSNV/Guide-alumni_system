<?php

 $select = $_POST['select'];
 $textarea = $_POST['textarea'];
 $name = $_POST['name'];
 $id_post = $_POST['id_post'];
include '../config/conf.php';
//***********************************บันทึกข้อมูลที่โพส*******************************************
$post_new_id = sprintf("post")."-".date("ymdHis")."-".rand(0,9999);//สร้างรหัสผ่าน

if ($id_post!='') {
  // echo "UPDATE";
  $query = $conn->prepare('UPDATE news_post SET news_post_name = :news_post_name, news_post_detail = :news_post_detail, news_post_type = :news_post_type WHERE news_post_id = :news_post_id');
  $result = $query->execute([
                      'news_post_name' => $name,
                      'news_post_detail' => $textarea,
                      'news_post_type' => $select,
                      'news_post_id' => $id_post,
  ]);

}else {
  // echo "INSERT";
  $query = $conn->prepare('INSERT INTO news_post(news_post_id, news_post_name,news_post_detail,news_post_type) VALUES(:news_post_id, :news_post_name,:news_post_detail, :news_post_type)');
  $result = $query->execute(array(
                      'news_post_id' => $post_new_id,
                      'news_post_name' => $name,
                      'news_post_detail' => $textarea,
                      'news_post_type' => $select,
                     
                    ));
}
if ($result) {include '../service/load_post_succese.html';}




?>