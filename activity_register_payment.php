<?php @session_start();
include 'config/conf.php';
@$id = @$_GET['id'];
@$activity_id = @$_GET['activity_id'];

try {

    $sql = "SELECT * FROM event_list LEFT JOIN activity ON event_list.event_list_type = activity.activity_id  Where event_list.event_list_id='$id' ORDER BY `activity`.`activity_id` ASC";
    $query = $conn->prepare($sql);
    $query->execute();
} catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}
// echo $sql;

try {
    $sql2 = "SELECT * FROM alumni WHERE id ='" . $_SESSION['use_id'] . "'";
    @$alumnis = $conn->prepare($sql2);
    @$alumnis->execute();
} catch (\Exception $e) {
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
    <?php include 'index.php'; ?>
    <div class="container login">
        <div class="card"><br>


            <?php
            if ($query->rowCount() > 0) {
                while ($data = $query->fetch(PDO::FETCH_OBJ)) {
            ?>
                    <h2>ชำระเงิน เข้าร่วมกิจกรรม <?= $data->event_list_name; ?></h2>

                    <div class="card-body">

                        <div class="card1">
                            <?php
                            while ($data1 = $alumnis->fetch(PDO::FETCH_OBJ)) { ?>

                                <h4> ชื่อ-สกุล:<?php echo $data1->std_title_name . $data1->std_name . '  ' . $data1->std_lastname; ?></h4>
                                <br>
                                <!-- เบอร์: <?php echo $data1->std_phone ?><br>
                                ปีการศึกษา:<?php echo $data1->std_year_start . '-' . $data1->std_year_complete ?><br> -->
                            <?php } ?>
                            <hr>

                            วันที่: <?php echo $data->event_list_day; ?>
                            เวลา: <?php echo $data->event_list_time; ?> - <?php echo $data->event_list_time_end; ?> น. <br>
                            สถานที่: <?php echo $data->event_list_loca; ?> <br>
                            ค่าใช้จ่าย <?php echo $data->charges; ?> บาท.<br>
                            เลขที่บัญชี: 12345678890 <br> <br>
                            <div align=center>
                                <img src="" width="180px" id="img_show" alt=""><br>
                                <form method="post" enctype="multipart/form-data" action="service/activity_register_process_update.php">
                                    <input type="hidden" id="id" name="id" value="<?= $activity_id; ?>" />
                                   
                                  <br><br>
                                   <img style="   border-radius: 5px;" src="pubilc/image/payment.jpg" width="200px" id="" name="">
                                
                                   <br><br>
                                        <input type="file" name="payment_img" id="payment_img" class="form-control" accept="image/*" placeholder="แนบสลิป" /> 
                                        <br><br>
                                        <a href="service/activity_register_process_delete.php?id=<?= $activity_id; ?>">
                                            <button type="button" class="btn btn-danger">ลบการลงทะเบียน</button>
                                        </a>
                                        <input type="submit" id="insert" value="ยืนยันการชำระเงิน" class="btn btn-success" />
                                    </form>

                            </div>
                            <br>


                        </div><br>


                <?php }
            } ?>
                    </div>
        </div>
    </div>



    <script>
        function getImageValue() {
            // Get the file input element
            var input = document.getElementById("payment_img");

            // Get the selected file
            var file = input.files[0];

            // Get the file name
            var fileName = file.name;

            // Get the file type
            var fileType = file.type;

            // Get the file size
            var fileSize = file.size;

            // Display the file name, type, and size
            console.log("Selected file name: " + fileName);
            console.log("Selected file type: " + fileType);
            console.log("Selected file size: " + fileSize);
            var objectUrl = URL.createObjectURL(file);

            // Set object URL as src attribute of img element
            var img = document.getElementById("img_show");
            img.src = objectUrl;
        }
    </script>
</body>



</html>