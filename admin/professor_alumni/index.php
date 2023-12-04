<?php
include '../../config/conf.php';
try {
    $sql = "SELECT * FROM alumni WHERE state = 0 ";
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
    <title>รายชื่อศิษย์เก่า</title>
    
<?php 
    @$pwd_not_math = @$_GET['pwd_not_math'];
    if (@$pwd_not_math) { ?>
    <script>
    Swal.fire({
        title: 'รหัสผ่านของคุณไม่ตรงกัน',
        icon: 'error',
        html:'<h3><b>กรุณาทำรายการใหม่</b></h3>' ,

    });
    </script>
<?php }?>



</head>

<body>

<div class="blog-card">
    <a href="../../index.php"  id="back"><img src="https://img.icons8.com/flat-round/64/000000/circled-left.png"/></a>
    <h1 align="center" class="title">ข้อมูลศิษย์เก่า</h1>
        <div class="inner-part">
            <div class="content content-1">
               
                    <!-- <div style="width:100%;text-align:right;">
                <button type="button" name="add" id="add" data-toggle="modal" class="btn btn-primary" data-target="#addModal">เพิ่ม</button>
                    </div> -->
                <div class="table-responsive">
                <table class="table table-bordered">
                    <tr align="center">
                        <th width="12%">ชื่อ-สกุล</th>
                        <th width="30%">ระดับการศึกษา</th>
                        <th width="10%">ติดต่อ</th>
                        <th width="8%">สถานะ</th>
                        <th width="8%">เพิ่มเติม</th>
                        <!-- <th width="8%">แก้ไข</th>
                        <th width="8%">ลบ</th> -->
                    </tr>
                    <tbody>
                        <?php
            if ($query->rowCount()>0) {
              $i = 1;
              while ($data = $query -> fetch(PDO::FETCH_OBJ)) {
            ?>
                        <tr>
                            <th><?=$data->std_title_name.$data->std_name."-".$data->std_lastname;?></th>
                            <th><?="ระดับการศึกษา ".$data->prog_id." ปีที่เข้าเรียน ".$data->std_year_start." ปีที่จบ ".$data->std_year_complete;?></th>
                            <th><?="เบอร์:".$data->std_phone;?> อีเมล:<?=$data->std_email;?></th>
                            <th>
                                <?php
                                    if ($data->state == 0) {
                                    ?>
                                  รอการอนุมัติ
                                <input type="button" name="view" value="รอการอนุมัติ" class="btn btn-warning approve"
                                    id="<?=$data->id;?>" />
                                <?php }else{ ?>
                                <input type="button" name="view" value="อนุมัติแล้ว" class="btn btn-success refuse"
                                    id="<?=$data->id;?>" />
                                    อนุมัติแล้ว
                                <?php }?>
                            </th>
                            <th><input type="button" name="view" value="ดูข้อมูล" class="btn btn-info view_data"
                                    id="<?=$data->id;?>" /></th>
                            <!-- <th><input type="button" name="edit" value="แก้ไข" class="btn btn-primary update_data"
                                    id="<?=$data->id;?>" /></th>
                            <th><input type="button" name="delete" value="ลบ" class="btn btn-danger delete_data"
                                    id="<?=$data->id;?>" /></th> -->
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
        $('#id').val("");
        $('#std_id').val("");
        $('#std_password').val("");
        $('#std_title_name').val("");
        $('#std_name').val("");
        $('#std_lastname').val("");
        $('#std_phone').val("");
        $('#std_email').val("");
        $('#prog_id').val("");
        $('#std_year_start').val("");
        $('#std_year_complete').val("");
        $('#std_company').val("");
        $('#std_compamy_phone').val("");
        $('#std_job_salary').val("");
        $('#insert').val("บันทึกข้อมูล"); //เปลี่ยนข้อมความในปุ่ม insert เป็น บันทึกข้อมูล
    });
    $('#insert-form').on('submit', function(
        e
    ) { //อ้างอิงถึง id ที่ชื่อ insert-form mี่อยู่ใน insertModal และเมื่อมีการกด submit ให้ทำ? /*ดูบรรทัดถัดไป*/
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
            },
            error: function(data) {
                
                Swal.fire({
                    title: 'รหัสผ่านของคุณไม่ตรงกัน',
                    icon: 'error',
                    html: '<h3><b>กรุณาทำรายการใหม่</b></h3>',
                });
            }
        });
    });
    //update
    $('.update_data').click(function() { //เมื่อมีการกดปุ่ม view_data
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิว 
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#id').val(data.id);
                $('#std_id').val(data.std_id);
                $('#std_password').val(data.std_password);
                $('#std_title_name').val(data.std_title_name);
                $('#std_name').val(data.std_name);
                $('#std_lastname').val(data.std_lastname);
                $('#std_phone').val(data.std_phone);
                $('#std_email').val(data.std_email);
                $('#std_address').val(data.std_address);
                $('#prog_id').val(data.prog_id);
                $('#std_year_start').val(data.std_year_start);
                $('#std_year_complete').val(data.std_year_complete);
                $('#std_company').val(data.std_company);
                $('#std_compamy_phone').val(data.std_compamy_phone);
                $('#std_job_position').val(data.std_job_position);
                $('#std_job_salary').val(data.std_job_salary);
                $('#insert').val("บันทึกข้อมูล"); //เปลี่ยนข้อมความในปุ่ม insert เป็น บันทึกข้อมูล
                $('#addModal').modal('show');
            }
        });
    });
    //delete
    $('.delete_data').click(function() { //ตรวจสอบคลาส delete_data เมื่อมีการกดปุ่ม
        var id = $(this).attr("id"); //รับค่า id จากปุ่มdelete 
        console.log(id)
        //var status=confirm("Are you want delete ?");
        swal({
            title: 'ต้องการลบข้อมูล?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'ยกเลิก',
            confirmButtonText: 'ลบข้อมูล!'
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
        var id = $(this).attr("id"); //รับค่า id จากปุ่มวิว 
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
//approve
$('.approve').click(function() { //ตรวจสอบคลาส approve เมื่อมีการกดปุ่ม
    var id = $(this).attr("id"); //รับค่า id จากปุ่ม approve
    console.log(id)

    swal({
        title: 'Are you sure?',
        text: "You want be approve!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0ec81d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
        if (result.value) { //เช็กค่าว่าเป็น T|F
            console.log(result.value); //ปริ้นค้าออกทาง console log
            $.ajax({
                url: "approve.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                method: "post", //ด้วย method post
                data: {
                    id: id
                }, //ส่งข้อมูลไปในรูปแบบ JSON
                success: function(data) { // หากส่งข้อมูลสำเร็จ
                    console.log(data);
                    swal(
                        'approved!',
                        'Your user has been approved.',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                        }
                    });
                }
            });
        }
    });
});
//refuse
$('.refuse').click(function() { //ตรวจสอบคลาส refuse เมื่อมีการกดปุ่ม
    var id = $(this).attr("id"); //รับค่า id จากปุ่ม refuse
    console.log(id)

    swal({
        title: 'Are you sure?',
        text: "You want be refuse!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0ec81d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, refuse it!'
    }).then((result) => {
        if (result.value) { //เช็กค่าว่าเป็น T|F
            console.log(result.value); //ปริ้นค้าออกทาง console log
            $.ajax({
                url: "refuse.php", //ส่งข้อมูลไปทีไฟล์ delete.php
                method: "post", //ด้วย method post
                data: {
                    id: id
                }, //ส่งข้อมูลไปในรูปแบบ JSON
                success: function(data) { // หากส่งข้อมูลสำเร็จ
                    console.log(data);
                    swal(
                        'refused!',
                        'Your user has been refused.',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload(); //โหลดหน้าเว็บใหม่อีกครั้ง
                        }
                    });
                }
            });
        }
    });
});
</script>

</html>