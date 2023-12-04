<?php @session_start();
include 'config/conf.php';
try {
    $sql = "SELECT * FROM activity";
    $query = $conn->prepare($sql);
    $query->execute();
    $sql1 = "SELECT * FROM event_list  LEFT JOIN activity ON event_list.event_list_type = activity.activity_id ORDER BY `activity`.`activity_id` ASC";
    $query1 = $conn->prepare($sql1);
    $query1->execute();
} catch (\Exception$e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรม</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="pubilc/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="pubilc/css/style_card.css" rel="stylesheet">

    <style>
        .login {
            margin-top: 2.5rem;
            padding-bottom: 10rem;
            max-width: 100%;
        }


        .card {
            margin: 0rem 10rem;
            max-width: 70%;
        }

        .card-1 {
            max-width: 45%;
            margin-left: 25%;
            border-style: hidden;
        }

        h2 {
            margin-left: 2.5rem;
        }

        input {
            margin-bottom: 2.5rem;
        }
    </style>
</head>

<body>
    <?php
@$post_succes = @$_GET['post'];

if (@$post_succes == 'succes') {

    ?>
        <script>
            Swal.fire({
                title: 'คุณได้ลงทะเบียนเข้าร่วมกิจกรรมเรียบร้อยแล้ว',
                text: '',
                icon: 'success',

            });
        </script>
    <?php }?>

    <?php

if (@$post_succes == 'update') {

    ?>
        <script>
            Swal.fire({
                title: 'ยืนยันลงทะเบียนเข้าร่วมกิจกรรมเรียบร้อยแล้ว',
                text: '',
                icon: 'info',

            });
        </script>
    <?php }?>

    <?php

if (@$post_succes == 'delete') {

    ?>
        <script>
            Swal.fire({
                title: 'ยกเลิกลงทะเบียนเข้าร่วมกิจกรรมเรียบร้อยแล้ว',
                text: '',
                icon: 'warning',

            });
        </script>
    <?php }?>



    <?php include 'index.php';?>
    <div class="container login">
        <!-- <a href="admin/set_activity/">
        <button type="button" class="btn btn-primary">เพิ่มการจัดกิจกรรม</button>
    </a> -->
        <br>
        <div class="table-responsive">
            <h4 align="center">ตารางกิจกรรม</h4>

            <br>
            <table class="table table-bordered">
                <tr>

                    <th width="12%">ชื่อกิจกรรม</th>
                    <th width="13%"> วันที่</th>
                    <th width="15%">เวลา</th>
                    <th width="10%">ค่าใช้จ่าย</th>
                    <th width="15%">สถานที่</th>
                    <?php if (@$_SESSION['use_state'] !== 'admin' and @$_SESSION['use_name'] != "") {?> <th width="25%"></th> <?php }?>
                </tr>
                <tbody>
                    <?php
if ($query1->rowCount() > 0) {
    $i = 1;

    while ($data = $query1->fetch(PDO::FETCH_OBJ)) {
        ?>

                            <tr>
                                <th> <a href="news_activity.php?id=<?=$data->event_list_id;?>"> <?=$data->event_list_name;?> </a></th>
                                <th> <a href="news_activity.php?id=<?=$data->event_list_id;?>"> <?=$data->event_list_day;?> </a></th>
                                <th> <a href="news_activity.php?id=<?=$data->event_list_id;?>"> <?=$data->event_list_time . ' - ' . $data->event_list_time_end;?> น. </a></th>
                                <th> <a href="news_activity.php?id=<?=$data->event_list_id;?>"> <?=$data->charges;?> บาท. </a></th>
                                <th> <a href="news_activity.php?id=<?=$data->event_list_id;?>"> <?=$data->event_list_loca;?> </a></th>

                                <?php if (@$_SESSION['use_state'] !== 'admin' and @$_SESSION['use_name'] != "") {
            $sql2 = "SELECT * FROM activity_register WHERE  activity_id = '" . $data->event_list_id . "' AND user_id ='" . $_SESSION['use_id'] . "'";
            $query2 = $conn->prepare($sql2);
            $query2->execute();
            $row = $query2->fetch(PDO::FETCH_OBJ);
            if ($row != false) {?>


                                        <th>
                                            <div style="float:left">
                                            <?php if ($row->status_payment == 0) {?>
                                            <a href="activity_register_data.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-regiter' class="btn btn-warning" >รอการอนุมัติ</button>
                                             </a>
                                             <?php } else {?>
                                                <a href="activity_register_data.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-regiter' class="btn btn-success" >ลงทะเบียนแล้ว</button>
                                             </a>
                                                <?php }?>
                                            </div>
                                            <?php if ($row->payment_url && $row->status_payment == 1) {?>

                                            <div style="float:left; margin-left:20px;">
                                                <a href="activity_register_data.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-payment' class="btn btn-info " > ชำระเงินแล้ว  </button>
                                                </a>
                                            </div>
                                            <?php } elseif ($row->status_payment == 0) {?>
                                            <div style="float:left; margin-left:20px;">
                                                <a href="activity_register_payment.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-payment' class="btn btn-warning" > รอการตรวจสอบ</button>
                                                </a>
                                            </div>
                                                <?php } else {
                ?>
                                                     <div style="float:left; margin-left:20px;">
                                                <a href="activity_register_payment.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-payment' class="btn btn-danger" > รอชำระเงิน</button>
                                                </a>
                                            </div>
                                                    <?php }?>
                                            </th>




                                    <?php
} else {
                if (@$_SESSION['use_state'] !== 'admin' and @$_SESSION['use_name'] != null) {

                    ?>
                                        <th>
                                        <div style="float:left">
                                            <a href="activity_register.php?id=<?=$data->event_list_id;?>">
                                                <button type="button" class="btn btn-secondary">ลงทะเบียน</button>
                                            </a>
                                        </div>
                                        </th>
                                <?php }}
        }?>
                            </tr>

                    <?php }
}?>
                </tbody>
            </table>
        </div>
    </div>

    <style>
        a {
            color: black;
        }

        th {
            text-align: center;
        }

        .blog-card {
            max-width: 100% !important;
        }

        .swal2-icon.swal2-info {
            font-size: 10px;
        }

        .swal2-icon.swal2-warning {
            font-size: 10px;
        }
    </style>
</body>

</html>





                                <!-- <?php if (@$_SESSION['use_state']) {
    $sql2 = "SELECT * FROM activity_register WHERE  activity_id = '" . $data->event_list_id . "' AND user_id ='" . $_SESSION['use_id'] . "'";
    $query2 = $conn->prepare($sql2);
    $query2->execute();
    // $row = $query2->fetch(PDO::FETCH_OBJ);

    // echo ($row);
    if ($query2->rowCount() > 0) {

        while ($item = $query2->fetch(PDO::FETCH_OBJ)) {
            ?>
                                         <th>
                                            <div style="float:left">
                                            <a href="activity_register_data.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-regiter' class="btn btn-success" >ลงทะเบียนแล้ว</button>
                                             </a>
                                            </div>
                                            <?php

            if ($item->payment_url) {?>

                                            <div style="float:left; margin-left:20px;">
                                                <a href="activity_register_data.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-payment' class="btn btn-info " >  ชำระเงินแล้ว  </button>
                                                </a>
                                            </div>
                                            <?php } else {?>
                                            <div style="float:left; margin-left:20px;">
                                                <a href="activity_register_data.php?id=<?=$data->event_list_id;?>&activity_id=<?=$row->id;?>">
                                                    <button type="button" id='btn-payment' class="btn btn-warning" > รอชำระเงิน</button>
                                                </a>
                                            </div>
                                                <?php }?>
                                            </th>
                                    <?php

            ?>

                                <?php }} else {?>
                                       <th>
                                       <div  style="float:left">

                                           <a href="activity_register.php?id=<?=$data->event_list_id;?>">
                                               <button type="button" class="btn btn-info">ลงทะเบียน</button>
                                           </a>
                                       </div>
                                   </th>
                                   <?php }

}?> -->