<?php @session_start();
include 'config/conf.php';
@$login_error = @$_GET['login_error'];
try {
    $sql = "SELECT * FROM news_post  ORDER BY `news_post`.`create_date` ASC";
    $query = $conn->prepare($sql);
    $query->execute();
} catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}

try {

    $sql1 = "SELECT * FROM event_list  LEFT JOIN activity ON event_list.event_list_type = activity.activity_id ORDER BY `activity`.`activity_id` ASC";
    $query1 = $conn->prepare($sql1);
    $query1->execute();
} catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โพสต์ข่าวสาร</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="pubilc/css/style_card.css" rel="stylesheet">
    <link href="pubilc/css/style_post.css" rel="stylesheet">

    <style>
        .login {

            padding-bottom: 10px !important;
        }
    </style>
</head>

<body>
    <?php include('index.php'); ?>

    <div class="container login" align=center>
    <img class="img-fluid" src="pubilc/image/06.jpg" width="1220" >  <!-- รูปหน้าแรก -->
    </div>
    <div class="container login">
        <div class="card"><br>
            <h2>ข่าวกิจกรรม</h2>
            <div class="card-body">
                <?php
                if ($query1->rowCount() > 0) {


                    while ($data = $query1->fetch(PDO::FETCH_OBJ)) {
                        $detail = $data->event_list_detali;
                ?>


                        <h6> กิจกรรม <?php echo $data->event_list_name; ?></h6>
                        <label class="blue box ex5" for="long">
                            <img style="   border-radius: 5px;" src="pubilc/image/upload/<?= $data->img_name; ?>" width="150px" id="" name="">
                            <span class="coral item" style="padding: 10px;">
                                ประเภท: <?php echo $data->activity_name; ?><br>
                                วันที่: <?php echo $data->event_list_day; ?>
                                เวลา: <?php echo $data->event_list_time; ?><br>
                                สถานที่: <?php echo $data->event_list_loca; ?>
                                <?php
                                if (strlen($detail) > 100) {
                                    echo "รายละเอียด : " . substr($detail, 0, 100) . '<a href="news_activity.php?id=' . $data->event_list_id . '">...ดูเพิ่มเติม</a>';
                                } else {
                                    echo "รายละเอียด : " . $detail;
                                }
                                ?>

                            </span>
                        </label>
                        <hr>
                <?php }
                } ?>

            </div>
        </div>
    </div>

    <!-- <div class="container login">
        <div class="card"><br>
            <h2>ข่าวประชาสัมพันธ์</h2>
            <div class="card-body">
                <?php
                if ($query->rowCount() > 0) {
                    while ($data = $query->fetch(PDO::FETCH_OBJ)) {
                        $detail = $data->news_post_detail;
                ?>

                        <label class="blue box ex5" for="long">

                            <span class="coral item">
                                <?php
                                if (strlen($detail) > 100) {
                                    echo "- " . substr($detail, 0, 100) . '<a href="news_comment.php?id=' . $data->news_post_id . '">...ดูเพิ่มเติม</a>';
                                } else {
                                    echo "- " . $detail;
                                }
                                ?>
                                <hr>
                            </span>
                        </label>



                <?php }
                } ?>

            </div>
        </div>
    </div> -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</body>

</html>