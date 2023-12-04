<?php @session_start();
include 'config/conf.php';
@$id = @$_GET['id'];

try {

    $sql = "SELECT * FROM event_list LEFT JOIN activity ON event_list.event_list_type = activity.activity_id  Where event_list.event_list_id='$id' ORDER BY `activity`.`activity_id` ASC";
    $query = $conn->prepare($sql);
    $query->execute();
} catch (\Exception$e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}
// echo $sql;

try {
    $sql2 = "SELECT * FROM alumni WHERE id ='" . $_SESSION['use_id'] . "'";
    @$alumnis = $conn->prepare($sql2);
    @$alumnis->execute();
} catch (\Exception$e) {
    // echo "ไม่สามารถพบข้อมูลได้";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนเข้าร่วมกิจกรรม</title>

    <link href="pubilc/css/style_card.css" rel="stylesheet">
    <link href="pubilc/css/style_post.css" rel="stylesheet">



</head>

<body>
    <?php include 'index.php';?>
    <div class="container login">
        <div class="card"><br>


            <?php
if ($query->rowCount() > 0) {
    while ($data = $query->fetch(PDO::FETCH_OBJ)) {
        ?>
                    <h2>ลงทะเบียนเข้าร่วมกิจกรรม <?=$data->event_list_name;?></h2>

                    <div class="card-body">

                        <div class="card1">
                        <?php
                            while ($data1 = $alumnis->fetch(PDO::FETCH_OBJ)) {?>

                           <h4> ชื่อ-สกุล:<?php echo $data1->std_title_name . $data1->std_name . '  ' . $data1->std_lastname; ?></h4>
                           <br>
                            <!-- เบอร์: <?php echo $data1->std_phone ?><br>
                                ปีการศึกษา:<?php echo $data1->std_year_start . '-' . $data1->std_year_complete ?><br> -->
                                <?php }?>
                            <hr>
                            ประเภท: <?php echo $data->activity_name; ?> <br>
                            วันที่: <?php echo $data->event_list_day; ?>
                            เวลา: <?php echo $data->event_list_time; ?> - <?php echo $data->event_list_time_end; ?> น. <br>
                            สถานที่: <?php echo $data->event_list_loca; ?> <br>
                            ค่าใช้จ่าย <?php echo $data->charges; ?> บาท.<br>
                            รายละเอียดดังนี้: <?php echo $data->event_list_detali; ?> <br> <br>
                            <div align=center>
                                <img style="   border-radius: 5px;" src="pubilc/image/upload/<?=$data->img_name;?>" width="480px" id="" name="">
                            </div>
                                <br><br>
                            <a href= "service/activity_register_process.php?id=<?= $data->event_list_id; ?>">
                                   <center> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myLongin">ลงทะเบียน</button></center>
                                     </a>

                        </div><br>


                <?php }
}?>
                    </div>
        </div>
    </div>
</body>



</html>