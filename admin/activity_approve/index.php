<?php
include '../../config/conf.php';
try {
    $sql = "SELECT
    activity_register.id,
    activity_register.status,
    activity_register.status_payment,
    activity_register.payment_url ,
    alumni.std_title_name,
    alumni.std_name,
    alumni.std_lastname,
    alumni.std_phone,
    alumni.std_email,
    alumni.std_address,
    alumni.prog_id,
    alumni.std_year_start,
    alumni.std_year_complete,
    event_list.event_list_name,
    event_list.event_list_day,
    event_list.event_list_time,
    event_list.event_list_time_end,
    event_list. event_list_loca,
    event_list.event_list_detali,
    event_list.img_name,
    event_list.charges,
    activity.activity_name
    FROM activity_register
    INNER JOIN alumni ON activity_register.user_id=alumni.id
    INNER JOIN event_list ON activity_register.activity_id=event_list.event_list_id
    INNER JOIN activity ON event_list.event_list_type=activity.activity_id"
    ;
    $query = $conn->prepare($sql);
    $query->execute();
} catch (\Exception$e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
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
        <h1 align="center" class="title">จัดการข้อมูลการลงทะเบียนกิจกรรม</h1>
        <div class="inner-part">
            <div class="content content-1">
                <div class="title">กิจกรรม</div>
                    <!-- <div style="width:100%;text-align:right;">
                        <button type="button" name="add" id="add" data-toggle="modal" class="btn btn-primary" data-target="#addModal">เพิ่ม</button>
                    </div> -->
                    <div class="table-responsive">
                    <table class="table table-bordered" >
                        <tr align="center">
                            <th witth="5">ลำดับ</th>
                            <th width="30%">ศิษย์เก่า</th>
                            <th width="50%">กิจกรรม</th>
                            <!-- <th width="12%">เพิ่มเติม</th> -->
                            <th width="20%">การเข้าร่วม</th>
                            <th width="12%">การชำระเงิน</th>
                            <!-- <th width="12%">ลบ</th> -->
                        </tr>
                        <tbody>
                            <?php
if ($query->rowCount() > 0) {
    $i = 1;
    while ($data = $query->fetch(PDO::FETCH_OBJ)) {
        ?>
                            <tr>
                                <th><?=$i++;?></th>

                                <th>
                                    <?=$data->std_title_name .' '. $data->std_name .' '. $data->std_lastname . ' <br> เบอร์โทร :'.$data->std_phone;?> <br>
                                    <?=$data->prog_id . ' เข้ารับการศึกษา '.$data->std_year_start .'-'. $data->std_year_complete;?>
                                </th>
                                <th>
                                <?php echo  'ประเภท '. $data->activity_name  .'กิจกรรม '.$data->event_list_name; ?> <br>
                                    วันที่: <?php echo $data->event_list_day; ?>
                                    เวลา: <?php echo $data->event_list_time; ?> - <?php echo $data->event_list_time_end; ?> น. <br>
                                    สถานที่: <?php echo $data->event_list_loca; ?> <br>
                                    ค่าใช้จ่าย <?php echo $data->charges; ?> บาท.<br>
                                </th>
                                <!-- <th><input type="button" name="view" value="ดูข้อมูล" class="btn btn-info view_data"
                                        id="<?=$data->id;?>" /></th> -->
                                <th>
                             
                                    <input type="button" name="edit" value="อนุมัติ" class="btn btn-primary update_data3" id="<?=$data->id;?>" />
                                   
                                    <input type="button" name="edit" value="ไม่อนุมัติ" class="btn btn-danger update_data4" id="<?=$data->id;?>" />
                                 
                                    </th>
                                  
               
                                
                                <th>
                                <?php if($data->status_payment == 0) { ?>
                                    <input type="button" name="edit" value="ยืนยันการชำระเงิน" class="btn btn-primary update_data" id="<?=$data->id;?>" />
                                    <?php }else{ ?>
                                    <input type="button" name="edit" value="ยกเลิกการชำระเงิน" class="btn btn-danger update_data2" id="<?=$data->id;?>" />
                                    <?php } ?>
                                    </th>
                                <!-- <th><input type="button" name="delete" value="ลบ" class="btn btn-danger delete_data"
                                        id="<?=$data->id;?>" /></th> -->
                            </tr>
                            <?php }}?>
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
        $('#id').val("");
        $('#status').val("");
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
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        var status = '1'
        var text = 'ยืนยันการชำระเงินเรียบร้อย'
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                id: id,
                status: status,
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                        swal(
                            text,
                            'Your user has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location
                            .reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                            }
                        });
            }
        });
    });
    //update
    $('.update_data2').click(function() { //เมื่อมีการกดปุ่ม view_data
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        var status = '0'
        var text = 'ยกเลิกการชำระเงินเรียบร้อย'
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                id: id,
                status: status,
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                        swal(
                            text,
                            'Your user has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location
                            .reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                            }
                        });
            }
        });
    });
    $('.update_data3').click(function() { //เมื่อมีการกดปุ่ม view_data
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        var status = '1'
        var text = 'ยืนยันการเข้าร่วมเรียบร้อย'
        $.ajax({
            url: "fetch2.php",
            method: "post",
            data: {
                id: id,
                status: status,
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                        swal(
                            text,
                            'Your user has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location
                            .reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                            }
                        });
            }
        });
    });
    $('.update_data4').click(function() { //เมื่อมีการกดปุ่ม view_data
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        var status = '0'
        var text = 'ยกเลิกการเข้าร่วมเรียบร้อย'
        $.ajax({
            url: "fetch2.php",
            method: "post",
            data: {
                id: id,
                status: status,
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                        swal(
                            text,
                            'Your user has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location
                            .reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                            }
                        });
            }
        });
    });
    //delete
    $('.delete_data').click(function() { //ตรวจสอบคลาส delete_data เมื่อมีการกดปุ่ม
        var id = $(this).attr("id"); //รับค่า id จากปุ่มdeleteมาใส่ไว้ใน uid
        //var status=confirm("Are you want delete ?");
        swal({
            title: 'Are you sure?',
            text: "You want be delete this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) { //เช็กค่าว่าเป็น T|F
                console.log(result.value); //ปริ้นค้าออกทาง console log
                $.ajax({
                    url: "delete.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                    method: "post", //ด้วย method post
                    data: {
                        id: id
                    }, //ส่งข้อมูลไปในรูปแบบ JSON
                    success: function(data) { // หากส่งข้อมูลสำเร็จ
                        console.log(data);
                        swal(
                            'Deleted!',
                            'Your user has been deleted.',
                            'success'
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
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        console.log('id :>> ', id);
        $.ajax({
            url: "select.php", //ส่งข้อมูลไปทีไฟล์ select.php
            method: "post", //ด้วย method post
            data: {
                id: id
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