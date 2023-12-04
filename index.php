<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="asset/index.css">

</head>

<style>

</style>

<body>
    
    <?php
    @session_start(); //ประกาศ การใช้งาน session
    @$login_succes = @$_GET['login'];
    @$_SESSION['use_state'];
    @$_SESSION['use_name'];
    @$_SESSION['use_email'];
    include('insertModal.php');
    // echo "อาจารย์ ศิษย์เก่า admin";

    if (@$login_succes) { ?>
        <script>
            var use_name = '<?php echo @$_SESSION['use_name']; ?>'
            Swal.fire({
                title: 'ยินดีต้อนรับ',
                text: use_name,
                icon: 'success',
                html: '<h3><b>คุณ ' + use_name + '</b></h3>',

            });
            
        </script>
    <?php } ?>

    <?php
    @$logque_succes = @$_GET['logque'];
    if (@$logque_succes) { ?>
        <script>
            Swal.fire({
                title: 'คุณได้ออกจากระบบ',
                text: '',
                icon: 'success',

            });
        </script>
    <?php } ?>

    <div class="text-center header">
        <!-- แยกปุ่มตามสิทธิ์ -->

        <div class="ex2">
            <div class="coral item">
                <!-- <span class="pink item">Logo</span> -->
            </div>
            <div class="coral item">
                <?php if (@$_SESSION['use_state'] == "") { ?>


                    <a href="login.php">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myLongin">เข้าสู่ระบบ</button>
                    </a>



                <?php } else { ?>


                    <?php if (@$_SESSION['use_state'] != "admin") { ?>
                    <a href="admin/data_alumni">
                        <button type="button" class="btn btn-info" >ข้อมูลส่วนตัว</button>
                    </a>
                    <?php } ?>
                    <a href="service/logqut.php">
                        <button type="button" class="btn btn-danger">ออกจากระบบ</button>
                    </a>


                <?php } ?>
            </div>
        </div>




        <!-- eng -->
      
        <div style="text-align: left ; margin-top:-50px;">
            <img class="img-fluid" src="pubilc/image/iconmo.png" width="80" height="50">
            <h6>ระบบศิษย์เก่า |<?php echo @$_SESSION['use_name'] ?>|</h6>
            <h6>สาขาวิชาระบบสารสนเทศทางคอมพิวเตอร์</h6>
            <h6>คณะบริหารธุรกิจและเทคโนโลยีสารสนเทศ มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขต ขอนแก่น</h6>
        </div>

    </div>
   
    <div class="container  text-center" style="margin-top:5px">
        <!-- แยกปุ่มตามสิทธิ์ -->

        <ul class="nav nav-tabs">

            <li class="nav-item">
                <a class="nav-link " href="index_news.php">หน้าแรก</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="set_activity.php">กิจกรรม</a>
            </li>
            <?php if (@$_SESSION['use_state'] == "") { ?>
                <li class="nav-item">
                    <a class="nav-link " href="register_professor_alumni.php">ลงทะเบียนศิษย์เก่า</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="">ติดต่อเรา</a>
            </li>

            <?php } ?>

            <?php if (@$_SESSION['use_state'] == "admin") { ?>

                <?php if (@$_SESSION['use_state']) { ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link " href="post_news.php">โพสต์ข่าวสาร</a>
                    </li> -->
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="admin/users">ข้อมูลผู้ใช้งาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/professor_alumni">รายชื่อศิษย์เก่ารอการอนุมัติ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/professor_alumni-done">รายชื่อศิษย์เก่า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/course">ข้อมูลหลักสูตร</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/activity">ข้อมูลประเภทกิจกรรม</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="admin/set_activity/">จัดกิจกรรม</a>
                </li> <li class="nav-item">
                <a class="nav-link " href="set_activity.php">ตารางกิจกรรม</a>
            </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="admin/users">รายชื่อผู้ใช้งาน</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="admin/professor_alumni">รายชื่อศิษย์เก่า</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="admin/course">ประเภทหลักสูตร</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="admin/new_type">ประเภทข่าวสาร</a>
                </li> -->
               
                <!-- <li class="nav-item">
                    <a class="nav-link" href="admin/activity">ข้อมูลประเภทกิจกรรม</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="admin/activity_approve">ยืนยันการเข้าร่วมกิจกรรม</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="report_activity.php">รายงานกิจกรรม</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="report_salary.php">รายงานเงินเดือน</a>
                </li>
                
               
        </ul>
    <?php }
            if (@$_SESSION['use_state'] == "ศิษย์เก่า") { ?>

        <li class="nav-item">
            <a class="nav-link" href="user/Register_for_event.php">ลงทะเบียนเข้าร่วมกิจกรรม</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user/Confirm_event.php">ยืนยันการเข้าร่วมกิจกรรม</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="user/Notify_money_transfer.php">แจ้งโอนเงินเข้าร่วมกิจกรรม</a>
        </li>
        
    <?php } ?>
    

   
    
    </div>
    </div>
    </div>
    </div>
</body>
<?php include('footer.php'); ?>
<script>

    function show_data(id){
        alert(id)

    }
</script>
</html>