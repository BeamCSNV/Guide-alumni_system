<?php
include '../../config/conf.php';
try {
  $sql = "SELECT * FROM activity";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="../../pubilc/css/style.css" rel="stylesheet">
    <link href="../../pubilc/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../pubilc/node_modules/sweetalert2/dist/sweetalert2.min.css">



    <title>กิจกรรม</title>
</head>

<body>

<br><br>
    <div class="blog-card">
        <a href="../../index.php" id="back"><img
                src="https://img.icons8.com/flat-round/64/000000/circled-left.png" /></a>
        <h1 align="center" class="title">ข้อมูลประเภทกิจกรรม</h1>
        <div class="inner-part">
            <div class="content content-1">
               
                    <div style="width:100%;text-align:right;">
                        <button type="button" name="add" id="add" data-toggle="modal" class="btn btn-primary" data-target="#addModal">เพิ่ม</button>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr align="center">
                            <th witth="5">ลำดับ</th>
                            <th width="60%">กิจกรรม</th>
                            <th width="12%">แก้ไข</th>
                            <th width="12%">ลบ</th>
                        </tr>
                        <tbody>
                            <?php
                                if ($query->rowCount()>0) {
                                $i = 1;
                                while ($data = $query -> fetch(PDO::FETCH_OBJ)) {
                                ?>
                            <tr>
                                <th><?=$i++;?></th>

                                <th><?=$data->activity_name;?></th>
                            
                                <th><input type="button" name="edit" value="แก้ไข" class="btn btn-primary update_data"
                                        id="<?=$data->activity_id;?>" /></th>
                                <th><input type="button" name="delete" value="ลบ" class="btn btn-danger delete_data"
                                        id="<?=$data->activity_id;?>" /></th>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <?php include "viewModal.php";?>
    <?php include "insertModal.php";?>
    <script type="text/javascript" src="../../pubilc/bootstrap/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="../../pubilc/bootstrap/js/bootstrap.min.js"></script>
</body>
<script src="../../pubilc/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
$(document).ready(function() {
    $('#add').click(function() {
        $('#activity_id').val("");
        $('#activity_name').val("");
    });

    $('#insert-form').on('submit', function(
    e) { //อ้างอิงถึง id ที่ชื่อ insert-form mี่อยู่ใน insertModal และเมื่อมีการกด submit ให้ทำ? /*ดูบรรทัดถัดไป*/
        e
    .preventDefault(); //เวลาที่ทำการ debug ดูข้อมูลได้เลยไม่ต้องรีเฟสหน้า ใช้เพื่อดูการไหลของข้อมูลระหว่าง insert-form ไปยังไฟล์ insert.php
        $.ajax({ //เรียกใช้ ajax
            url: "insert.php", //ส่งข้อมูลไปที่ insert.php
            method: "post", //ด้วย method post
            data: $('#insert-form')
        .serialize(), //มัดข้อมูลร่วมกันแล้วส่งข้อมูลไปเป็นก้อนในรูปแบบ string
            beforeSend: function() { //ก่อนที่จะส่งข้อมูล
                $('#insert').val("Insert..."); //ให้ทำการเปลี่ยนข้อความบนปุ่มเป็น Insert...
            },
            success: function(data) { // หากส้งข้อมูลสำเร็จ
                $('#insert-form')[0].reset() //ให้รีเซ็ตข้อมูลที่อยู่ใน form ทั้งหมด
                $('#addModal').modal('hide'); //ปิด Modal
                location.reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
            }
        });
    });
    //update
    $('.update_data').click(function() { //เมื่อมีการกดปุ่ม view_data
        var activity_id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                activity_id: activity_id
            },
            dataType: "json",
            success: function(data) {
                $('#activity_id').val(data.activity_id);
                $('#activity_name').val(data.activity_name);
                $('#insert').val("บันทึกข้อมูล"); //เปลี่ยนข้อมความในปุ่ม insert เป็น Updateบันทึกข้อมูล
                $('#addModal').modal('show');
            }
        });
    });
    //delete
    $('.delete_data').click(function() { //ตรวจสอบคลาส delete_data เมื่อมีการกดปุ่ม
        var activity_id = $(this).attr("id"); //รับค่า id จากปุ่มdeleteมาใส่ไว้ใน uid
        //var status=confirm("Are you want delete ?");
        swal({
            title: 'ต้องการลบข้อมูล?',
            text: " ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'ยกเลิก',
            confirmButtonText: 'ลบข้อมูล'
        }).then((result) => {
            if (result.value) { //เช็กค่าว่าเป็น T|F
                console.log(result.value); //ปริ้นค้าออกทาง console log
                $.ajax({
                    url: "delete.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                    method: "post", //ด้วย method post
                    data: {
                        activity_id: activity_id
                    }, //ส่งข้อมูลไปในรูปแบบ JSON
                    success: function(data) { // หากส่งข้อมูลสำเร็จ
                        console.log(data);
                        swal(
                            'ลบข้อมูลเรียบร้อย!',
                             
                        ).then((result) => {
                            if (result.value) {
                                location
                            .reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                            }
                        });
                    }
                });
            }
        });
    });
    //View
    $('.view_data').click(function() { //เมื่อมีการกดปุ่ม view_data
        var activity_id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        $.ajax({
            url: "select.php", //ส่งข้อมูลไปทีไฟล์ select.php
            method: "post", //ด้วย method post
            data: {
                activity_id: activity_id
            }, //ส่งข้อมูลไปในรูปแบบ JSON
            success: function(data) { // หากส้งข้อมูลสำเร็จ
                $('#detail').html(
                data); //นำข้อมูลไปแสดงที่ Modal body ตรง id detail ในไฟล์ viewModal.php
                $('#dataModal').modal('show'); //เรียก Modal มาแสดง
            }
        });
    });
});
</script>

</html>