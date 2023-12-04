<?php @session_start();
include 'config/conf.php';
@$id  = @$_GET['id'];
try {
  $sql = "SELECT * FROM news_post WHERE news_post_id = '$id'";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}
try {
    $sql1 = "SELECT * FROM comment_post WHERE news_post_id = '$id' ORDER BY `comment_post`.`com_date` DESC";
    $query1 = $conn->prepare($sql1);
    $query1 ->execute();
  } catch (\Exception $e) {
    echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
  }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โพสต์ข่าวสาร</title>

    <link href="pubilc/css/style_card.css" rel="stylesheet">
    <link href="pubilc/css/style_post.css" rel="stylesheet">


    <style>
    .update_cm {
        margin-left: 0.3rem;
        color: #0074ff;
    }

    .delete_cm {
        margin-left: 0.5rem;
        color: #ff0000;
    }

    .update {
        margin-left: 0.3rem;
        color: #0074ff;
    }

    .delete {
        margin-left: 0.5rem;
        color: #ff0000;
    }
    </style>
</head>

<body>
    <?php include('index.php');?>
    <div class="container login">
        <div class="card"><br>
            <?php
            if ($query->rowCount()>0) {
                while ($data = $query -> fetch(PDO::FETCH_OBJ)) {
            ?>
            <h2><?=$data->news_post_type;?></h2>
            <div class="card-body">
                <div class="card1">

                    <div class="text">
                        <p>โดย: <?=$data->news_post_name;?>
                        </p>
                    </div>
                    <div class="text">
                        <p>เวลา: <?=$data->create_date;?></p>
                    </div>

                    <div class="post">
                        <h5>
                            <?=$data->news_post_detail;?>
                        </h5>
                    </div>
                    <!-- เช็คปุ่ม------ -->
                    <form action="edit_post_news.php" method="post">
                        <input type="hidden" id="news_post_name" name="news_post_name"
                            value="<?=$data->news_post_name;?>" />
                        <input type="hidden" id="news_post_id" name="news_post_id" value="<?=$data->news_post_id;?>" />
                        <input type="hidden" id="news_post_type" name="news_post_type"
                            value="<?=$data->news_post_type;?>" />
                        <input type="hidden" id="news_post_detail" name="news_post_detail"
                            value="<?=$data->news_post_detail;?>" />
                        <div>
                            <!-- ถ้าเป็น Admin ให้เปิดปุ่ม -->
                            <?php if (@$_SESSION['use_state'] =="admin") { ?>
                            <button type="submit" class="btn btn-link update">แก้ไข</button>
                            <div class="text delete" id="<?=$data->news_post_id;?>">ลบ</div>
                            <?php }?>
                        </div>
                    </form>


                </div><br>

                <div class="input-group ">
                    <input type="hidden" id="com_post_id" name="com_post_id" value="" />
                    <input type="hidden" id="com_user" name="com_user" value=" <?php echo @$_SESSION['use_name']?>" />
                    <input type="hidden" id="com_state" name="com_state" value=" <?php echo@$_SESSION['use_state']?>" />
                    <input type="hidden" id="news_post_id" name="news_post_id"
                        value=" <?php echo $data->news_post_id;?>" /><br>
                    <textarea class="form-control " id="com_post_detail" name="com_post_detail" rows="1"
                        placeholder="แสดงความคิดเห็น" required></textarea>
                    <div>
                        <button type="submit" class="btn btn-success comment">แสดงความคิดเห็น</button>
                    </div>
                </div>
                <?php }} ?>
                <div class="card-body">
                    <h4>ความคิดเห็น</h4>

                    <?php
                    if ($query1->rowCount()>0) {
                        $i = 1;
                        while ($data = $query1 -> fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <div class="card1">
                        <div class="text">
                            <p>โดย: <?=$data->com_post_user;?></p>
                        </div>
                        <div class="text">
                            <p>เวลา: <?=$data->com_date;?></p>
                        </div>
                        <div class="post">
                            <h5>
                                <?=$data->com_post_detail;?>
                            </h5>
                        </div>
                        <!-- เช็คปุ่ม------ -->
                        <div>

                            <div id="<?php echo $data->com_post_id;?>" style="display: none;">
                                <input type="hidden" id="com_user<?php echo $i?>" name="com_user"
                                    value=" <?php echo $data->com_post_user;?>" />
                                <input type="hidden" id="com_state<?php echo $i?>" name="com_state"
                                    value=" <?php echo $data->com_post_user_state;?>" />
                                <input type="hidden" id="com_post_id<?php echo $i?>" name="com_post_id"
                                    value=" <?php echo $data->com_post_id;?>" />
                                <input type="text" class="form-control" id="com_post_detail<?php echo $i?>"
                                    name="com_post_detail" value=" <?php echo $data->com_post_detail;?>" /> <br>
                                <button class="btn btn-warning update_data_cm" id="<?=$i;?>">บันทึก</button>
                            </div>
                            <!-- if ว่า เม้นนี้ใช้คนที่กำลังใช้งานอยู่ไหม -->
                            <?php 
                             $use_name = $data->com_post_user;
                            if (@$_SESSION['use_name'] == $use_name) { ?>
                            <button type="submit" class="btn btn-link update_cm"
                                id="<?php echo $data->com_post_id;?>">แก้ไขคอมเม้น</button>
                            <div class="text delete_cm" id="<?=$data->com_post_id;?>">ลบคอมเม้น</div>
                            <?php }?>
                            <!-- end if -->
                        </div>
                    </div><br>


                    <?php $i++;}} ?>
                </div>
            </div>
</body>

<script src="pubilc/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
$(document).ready(function() {
    //comment
    $('.comment').click(function() { //เมื่อมีการกดปุ่ม comment
        com_post_id = document.getElementById("com_post_id").value; //get value input นี้ com_post_id
        com_user = document.getElementById("com_user").value; //get value input นี้ com_user
        com_state = document.getElementById("com_state").value; //get value input นี้ com_state
        news_post_id = document.getElementById("news_post_id").value; //get value input นี้ news_post_id
        com_post_detail = document.getElementById("com_post_detail")
        .value; //get value input นี้ com_post_detail
        console.log(com_post_detail)
        if (com_post_detail === "") { //เช็คคค่าว่าง
            Swal.fire({
                title: 'ข้อมูลไม่ถูกต้อง',
                text: 'กรุณาลองใหม่อีกครั้ง',
                icon: 'error',

            });
        } else {
            $.ajax({
                url: "service/insert_com.php",
                method: "post",
                data: {
                    com_post_id: com_post_id,
                    com_user: com_user,
                    com_state: com_state,
                    news_post_id: news_post_id,
                    com_post_detail: com_post_detail
                },
                success: function(data) { // หากส่งข้อมูลสำเร็จ
                    $('#com_post_detail').val("");
                    Swal.fire({
                        title: 'คุณได้แสดงความคิดเห็น',
                        text: '',

                    });
                    window.setTimeout(function() {
                        window.location.reload()
                    }, 1000); //รีโหลดหน้าใหม่ รอ 1 วิ
                }

            });
        } /// end if

    });
    //delete
    $('.delete').click(function() { //เมื่อมีการกดปุ่ม delete โพส
        var news_post_id = $(this).attr("id"); //รับค่า id จากปุ่มdeleteมาใส่ไว้ใน uid
        swal({
            title: 'Are you sure?',
            text: "You want be delete this!",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) { //เช็กค่าว่าเป็น T|F
                console.log(result.value); //ปริ้นค้าออกทาง console log
                $.ajax({
                    url: "service/delete_post.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                    method: "post", //ด้วย method post
                    data: {
                        news_post_id: news_post_id
                    },
                    success: function(data) { // หากส่งข้อมูลสำเร็จ
                        console.log(data);
                        swal(
                            'Deleted!',
                            'Your post has been deleted.',
                            'success'
                        ).then((result) => { // รีโหลดหน้า index_news.php
                            if (result.value) {
                                window.location =
                                    '../alumni_system/index_news.php';

                            }
                        });
                    }
                });
            }
        });

    });

    //delete_cm
    $('.delete_cm').click(function() { //เมื่อมีการกดปุ่ม delete_cm  ความคิดเห็น
        var news_post_id = document.getElementById("news_post_id").value;
        var com_post_id = $(this).attr("id"); //รับค่า id จากปุ่ม delete_cm มาใส่ไว้ใน com_post_id
        swal({
            title: 'Are you sure?',
            text: "You want be delete this!",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) { //เช็กค่าว่าเป็น T|F
                $.ajax({
                    url: "service/delete_cm.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                    method: "post", //ด้วย method post
                    data: {
                        com_post_id: com_post_id
                    },
                    success: function(data) { // หากส่งข้อมูลสำเร็จ
                        console.log(data);
                        swal(
                            'Deleted!',
                            'Your comment has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                window.location =
                                    '../alumni_system/news_comment.php?id=' +
                                    news_post_id;

                            }
                        });
                    }
                });
            }
        });
    });

    //update_cm
    $('.update_cm').click(function() { //เมื่อมีการกดปุ่ม update_cm  ความคิดเห็น
        var com_post_id = $(this).attr("id"); //รับค่า id จากปุ่มdeleteมาใส่ไว้ใน com_post_id
        document.getElementById(com_post_id).style.display = "block";
    });

    //update
    $('.update_data_cm').click(function() { //เมื่อมีการกดปุ่ม แก้ไขคอมเม้น
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน แก้ไขคอมเม้น
        var com_user = document.getElementById("com_user" + id).value;
        var com_state = document.getElementById("com_state" + id).value;
        var com_post_id = document.getElementById("com_post_id" + id).value;
        var com_post_detail = document.getElementById("com_post_detail" + id).value;
        var news_post_id = document.getElementById("news_post_id").value;

        if (com_post_detail === "") { //เช็คคค่าว่าง
            Swal.fire({
                title: 'ข้อมูลไม่ถูกต้อง',
                text: 'กรุณาลองใหม่อีกครั้ง',
                icon: 'error',

            });
        } else {
            $.ajax({ //ส่งค่าแบบ ajax
                url: "service/insert_com.php",
                method: "post",
                data: {
                    com_user: com_user,
                    com_state: com_state,
                    com_post_detail: com_post_detail,
                    news_post_id: news_post_id,
                    com_post_id: com_post_id,
                },
                success: function(data) { // หากส่งข้อมูลสำเร็จ
                    console.log(data);
                    swal(
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location =
                                '../alumni_system/news_comment.php?id=' +
                                news_post_id;

                        }
                    });
                }
            });
        } // end if
    });
});
</script>

</html>