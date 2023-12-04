<?php
include '../../config/conf.php';
try {
  $sql = "SELECT * FROM gift";
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



    <title>ของที่ระลึก</title>
</head>

<body>
    <div class="blog-card">
        <div align="center"> </div>
        <a href="../../index.php" id="back"><img
                src="https://img.icons8.com/flat-round/64/000000/circled-left.png" /></a>
        <h1 align="center" class="title">จัดการข้อมูล</h1>
        <div class="inner-part">
            <div class="content content-1">
                <div class="title">ของที่ระลึก</div>
                <button type="button" name="add" id="add" data-toggle="modal" class="btn btn-primary"
                    data-target="#addModal">เพิ่ม</button>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr align="center">
                            <th witth="5">#</th>
                            <th width="30%">ชื่อ</th>
                            <th width="12%">ราคา(บาท)</th>
                            <th width="35%">รายละเอียด</th>

                            <th width="10%">เพิ่มเติม</th>
                            <th width="10%">แก้ไข</th>
                            <th width="10%">ลบ</th>
                        </tr>
                        <tbody>
                            <?php
                                if ($query->rowCount()>0) {
                                    $i = 1;
                                    while ($data = $query -> fetch(PDO::FETCH_OBJ)) {
                                ?>
                            <tr>
                                <th><?=$i++;?></th>
                                <th><?=$data->gift_name;?></th>
                                <th><?=$data->gift_price;?></th>
                                <th><?=$data->gift_detail;?></th>

                                <th><input type="button" name="view" value="View" class="btn btn-info view_data"
                                        id="<?=$data->gift_id;?>" /></th>
                                <th><input type="button" name="edit" value="Edit" class="btn btn-primary update_data"
                                        id="<?=$data->gift_id;?>" /></th>
                                <th><input type="button" name="delete" value="Delete" class="btn btn-danger delete_data"
                                        id="<?=$data->gift_id;?>" /></th>
                            </tr>
                </div>

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
    var myForm = document.getElementById('insert-form'); // Our HTML form's ID
    var myFile = document.getElementById('fileAjax'); // Our HTML files' ID

    myForm.onsubmit = function(event) {
        event.preventDefault();

        // Get the files from the form input
        var files = myFile.files;

        // Create a FormData object
        var formData = new FormData();

        // Select only the first file from the input array
        var file = files[0];
        var numbers = Math.random() * 10000000000000000000;
        const str = "img"
        var newname = str + numbers + '.png';
        // Renaming a File() object in JavaScript
        const myNewFile = new File([myFile], newname, {
            type: myFile.type
        });
        console.log(myNewFile.name)


        // Add the file to the AJAX request
        formData.append('fileAjax', file, myNewFile.name);
        // Set up the request
        var xhr = new XMLHttpRequest();

        // Open the connection
        xhr.open('POST', 'uploadHandling.php', true);


        // Send the data.
        xhr.send(formData);
        document.getElementById("gift_image").value = newname;
    }
    $('#add').click(function() {
        $('#gift_id ').val("");
        $('#gift_name').val("");
        $('#gift_price').val("");
        $('#gift_detail').val("");
        $('#gift_image').val("");
        $('#fileAjax').val("");
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
            }
        });
    });
    //update
    $('.update_data').click(function() { //เมื่อมีการกดปุ่ม view_data
        var gift_id = $(this).attr("id"); //รับค่า id จากปุ่มวิว 
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                gift_id: gift_id
            },
            dataType: "json",
            success: function(data) {
                $('#gift_id').val(data.gift_id);
                $('#gift_name').val(data.gift_name);
                $('#gift_price').val(data.gift_price);
                $('#gift_detail').val(data.gift_detail);
                $('#gift_image').val(data.gift_image);
               
                $('#insert').val("Update"); //เปลี่ยนข้อมความในปุ่ม insert เป็น Update
                $('#addModal').modal('show');
            }
        });
    });
    //delete
    $('.delete_data').click(function() { //ตรวจสอบคลาส delete_data เมื่อมีการกดปุ่ม
        var gift_id = $(this).attr("id"); //รับค่า id จากปุ่มdelete 
        console.log(gift_id)
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
                        gift_id: gift_id
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
        var gift_id = $(this).attr("id"); //รับค่า id จากปุ่มวิว 
        $.ajax({
            url: "select.php", //ส่งข้อมูลไปทีไฟล์ select.php
            method: "post", //ด้วย method post
            data: {
                gift_id: gift_id
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