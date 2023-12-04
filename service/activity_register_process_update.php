<html>

<head>
    <style>
        .body {
            background: #f3f3f3;
        }

        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: #fff;
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }

            50%,
            100% {
                top: 24px;
                height: 32px;
            }
        }
    </style>
</head>

<body class="body">
    <div align="center" style="margin-top:15%">
        <h2>กำลังบันทึกข้อมูล โปรดรอสักครู่ . . . </h2>

        <div align="center">
            <div class="lds-facebook">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div>

            <?php @session_start();
include '../config/conf.php';

@$use_id = $_SESSION['use_id'];
if (!empty($_POST['id'])) {
    @$id = @$_POST['id'];
    $temp_name = $_FILES['payment_img']['tmp_name'];
    $img_name = $_FILES['payment_img']['name'];
    $img_path = "../pubilc/image/upload/" . $img_name;
    move_uploaded_file($temp_name, $img_path);
    try {

        $sql = "UPDATE `activity_register` SET `payment_url` = '$img_name' WHERE `id` = $id";
        $query = $conn->prepare($sql);
        $query->execute();

        ?>
                <meta http-equiv='refresh' content='1;URL=../set_activity.php?post=updatepayment'>
            <?php
    } catch (\Exception$e) {
            echo "ไม่สามารถดึงข้อมูลได้: updatepayment " . $e->getMessage();
     }

} else {

    @$id = @$_GET['id'];
    try {

        $sql = "UPDATE `activity_register` SET `status` = '1' WHERE `id` = $id";
        $query = $conn->prepare($sql);
        $query->execute();

        ?>
                <meta http-equiv='refresh' content='1;URL=../set_activity.php?post=update'>
            <?php
        } catch (\Exception$e) {
                echo "ไม่สามารถดึงข้อมูลได้: update " . $e->getMessage();
        }
}
?>



</body>

</html>