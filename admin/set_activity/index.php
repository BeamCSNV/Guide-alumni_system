<?php
include '../../config/conf.php';
try {
    $sql = "SELECT * FROM event_list LEFT JOIN activity ON event_list.event_list_type = activity.activity_id";
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
        <a href="../../index.php" id="back"><img src="https://img.icons8.com/flat-round/64/000000/circled-left.png" /></a>
        <h1 align="center" class="title">ตารางจัดกิจกรรม</h1>
        <div class="inner-part">
            <div class="content content-1">
                
                <div style="width:100%;text-align:right;">
                <button type="button" name="add" id="add" data-toggle="modal" class="btn btn-primary" data-target="#addModal">เพิ่ม</button></div>
                <div class="table-responsive">
                    <table class="table table-bordered" style="text-align: center">
                        <tr align="center">
                            <!-- <th witth="5">#</th> -->
                            <th width="15%">ชื่อกิจกรรม</th>
                            <th width="15%">ประเภทการจัดกิจกรรม</th>
                            <th width="15%">วันที่-เวลา</th>
                            <th width="15%">สถานที่</th>
                            <th width="10%">ค่าใช้จ่าย</th>
                            <!-- <th width="23%">รายละเอียดเพิ่มเติม</th> -->
                            <th width="10%">รูปภาพ</th>
                            <th width="12%">แก้ไข</th>
                            <th width="12%">ลบ</th>
                        </tr>
                        <tbody>
                            <?php
if ($query->rowCount() > 0) {
    $i = 1;
    while ($data = $query->fetch(PDO::FETCH_OBJ)) {
        ?>
                                    <tr>
                                        <!-- <th><?=$i++;?></th> -->
                                        <th><?=$data->event_list_name;?></th>
                                        <th><?=$data->activity_name;?></th>
                                        <th><?=$data->event_list_day . ' : ' . $data->event_list_time . '-' . $data->event_list_time_end?>น.</th>
                                        <th><?=$data->event_list_loca;?></th>
                                        <th><?=$data->charges;?></th>
                                        <!-- <th><?=$data->event_list_detali;?></th> -->
                                        <th> <img src="../../pubilc/image/upload/<?=$data->img_name;?>" width="180px" id="" name=""> </th>
                                        <th><input type="button" name="edit" value="แก้ไข" class="btn btn-primary update_data" id="<?=$data->event_list_id;?>" /></th>
                                        <th><input type="button" name="delete" value="ลบ" class="btn btn-danger delete_data" id="<?=$data->event_list_id;?>" /></th>
                                    </tr>
                            <?php }
}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        th {
            text-align: center;
        }

        .blog-card {
            max-width: 100% !important;
        }
    </style>


    <?php include "insertModal.php";?>
    <script type="text/javascript" src="../../pubilc/bootstrap/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="../../pubilc/bootstrap/js/bootstrap.min.js"></script>
</body>
<script src="../../pubilc/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add').click(function() {
            $('#event_list_id').val("");
            $('#event_list_name').val("");
            $('#event_list_type').val("");
            $('#event_list_day').val("");
            $('#event_list_time').val("");
            $('#event_list_time_end').val("");
            $('#event_list_loca').val("");
            $('#event_list_detali').val("");
            $('#event_list_img').val("");
            $('#charges').val("0.0");
        });

        $('#insert-form').on('submit', function(
            e
        ) { //อ้างอิงถึง id ที่ชื่อ insert-form mี่อยู่ใน insertModal และเมื่อมีการกด submit ให้ทำ? /*ดูบรรทัดถัดไป*/
            var formData = new FormData($('#insert-form')[0]);

            e
                .preventDefault(); //เวลาที่ทำการ debug ดูข้อมูลได้เลยไม่ต้องรีเฟสหน้า ใช้เพื่อดูการไหลของข้อมูลระหว่าง insert-form ไปยังไฟล์ insert.php
            $.ajax({ //เรียกใช้ ajax
                url: "insert.php", //ส่งข้อมูลไปที่ insert.php
                method: "post", //ด้วย method post
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() { //ก่อนที่จะส่งข้อมูล
                    $('#insert').val("เพิ่มข้อมูลเรียบร้อย"); //ให้ทำการเปลี่ยนข้อความบนปุ่มเป็น Insert...
                },
                success: function(data) { // หากส้งข้อมูลสำเร็จ
                    // $('#insert-form')[0].reset() //ให้รีเซ็ตข้อมูลที่อยู่ใน form ทั้งหมด
                    // $('#addModal').modal('hide'); //ปิด Modal
                    // location.reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                }
            });
        });
        //update
        $('.update_data').click(function() { //เมื่อมีการกดปุ่ม view_data
            var event_list_id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
            $.ajax({
                url: "fetch.php",
                method: "post",
                data: {
                    event_list_id: event_list_id
                },
                dataType: "json",
                success: function(data) {
                console.log('data :>> ', data);
                    $('#event_list_id').val(data.event_list_id);
                    $('#event_list_name').val(data.event_list_name);

                    $('#event_list_day').val(data.event_list_day);
                    $('#event_list_time').val(data.event_list_time);
                    $('#event_list_time_end').val(data.event_list_time_end);
                    $('#event_list_loca').val(data.event_list_loca);
                    $('#event_list_detali').val(data.event_list_detali);
                    $('#charges').val(data.charges);
                    $('#img_name').val(data.img_name);
                    $('#img_show').attr('src', '../../pubilc/image/upload/' + data.img_name);
                    $('#insert').val("บันทึกข้อมูล"); //เปลี่ยนข้อมความในปุ่ม insert เป็น Updateบันทึกข้อมูล
                    $('#addModal').modal('show');

                    setTimeout(() => {
                   
                        document.getElementById("event_list_type").value = data.event_list_type;

                    }, "2000");


                }
            });
        });
        //delete
        $('.delete_data').click(function() { //ตรวจสอบคลาส delete_data เมื่อมีการกดปุ่ม
            var event_list_id = $(this).attr("id"); //รับค่า id จากปุ่มdeleteมาใส่ไว้ใน uid
            //var status=confirm("Are you want delete ?");
            swal({
                title: 'ต้องการลบข้อมูล?',
                text: " ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'ยกเลิก',
                confirmButtonText: 'ยืนยันลบข้อมูล'
            }).then((result) => {
                if (result.value) { //เช็กค่าว่าเป็น T|F
                    console.log(result.value); //ปริ้นค้าออกทาง console log
                    $.ajax({
                        url: "delete.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                        method: "post", //ด้วย method post
                        data: {
                            event_list_id: event_list_id
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
            var event_list_id = $(this).attr("id"); //รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
            $.ajax({
                url: "select.php", //ส่งข้อมูลไปทีไฟล์ select.php
                method: "post", //ด้วย method post
                data: {
                    event_list_id: event_list_id
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