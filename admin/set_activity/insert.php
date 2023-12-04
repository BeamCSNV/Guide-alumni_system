<?php
include '../../config/conf.php';
echo $event_list_id  = $_POST['event_list_id'];
echo $event_list_name  = $_POST['event_list_name'];
echo $event_list_type  = $_POST['event_list_type'];
echo $event_list_day  = $_POST['event_list_day'];
echo $event_list_time  = $_POST['event_list_time'];
echo $event_list_time_end  = $_POST['event_list_time_end'];
echo $event_list_loca  = $_POST['event_list_loca'];
echo $event_list_detali  = $_POST['event_list_detali'];
echo $charges  = $_POST['charges'];
echo $img_name  = $_POST['img_name'];





if(!empty($_FILES['event_list_img'])){
  echo 'รูปใหม่';
  $temp_name = $_FILES['event_list_img']['tmp_name'];
  $img_name = $_FILES['event_list_img']['name'];
  $img_path = "../../pubilc/image/upload/".$img_name;
  move_uploaded_file($temp_name, $img_path);
}
if( $img_name==""){
  $img_name  = $_POST['img_name'];
}



$event_list_new_id = sprintf("EV")."-".date("ymdHis")."-".rand(0,9999);
if ($event_list_id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE event_list SET 
  event_list_name = :event_list_name,
  event_list_type = :event_list_type,
  event_list_day = :event_list_day,
  event_list_time = :event_list_time,
  event_list_time_end = :event_list_time_end,
  event_list_loca = :event_list_loca,
  event_list_detali = :event_list_detali,
  charges = :charges,
  img_name = :img_name
  WHERE event_list_id = :event_list_id');
  $result = $query->execute([
    'event_list_name' => $event_list_name,
    'event_list_type' => $event_list_type,
    'event_list_day' => $event_list_day,
    'event_list_time' => $event_list_time,
    'event_list_time_end' => $event_list_time_end,
    'event_list_loca' => $event_list_loca,
    'event_list_detali' => $event_list_detali,
    'event_list_id' => $event_list_id,
    'charges' => $charges,
    'img_name' => $img_name,
  ]);

}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO event_list(event_list_id, event_list_name, event_list_type, event_list_day, event_list_time,event_list_time_end,event_list_loca, event_list_detali,charges,img_name)
                                           VALUES(:event_list_id, :event_list_name, :event_list_type, :event_list_day, :event_list_time,:event_list_time_end, :event_list_loca, :event_list_detali,:charges,:img_name)');
  $result = $query->execute(array(
                      'event_list_id' => $event_list_new_id,
                      'event_list_name' => $event_list_name,
                      'event_list_type' => $event_list_type,
                      'event_list_day' => $event_list_day,
                      'event_list_time' => $event_list_time,
                      'event_list_time_end' => $event_list_time_end,
                      'event_list_loca' => $event_list_loca,
                      'event_list_detali' => $event_list_detali,
                      'charges' => $charges,
                      'img_name' => $img_name,
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>


