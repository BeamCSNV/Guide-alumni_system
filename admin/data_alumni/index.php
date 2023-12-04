<?php
include '../../config/conf.php';
try {
    $id =  $_SESSION['use_id'];
  $sql = "SELECT * FROM alumni WHERE id = $id";
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
    <a href="../../index_news.php"  id="back"><img src="https://img.icons8.com/flat-round/64/000000/circled-left.png"/></a>
   <input type="hidden" name="user_id" id="user_id" value="<?php echo  $id ?>">
      
   <div class="container">
                    <div class="row" align="center">
                        <div class="col-md-12">
                            <div align="center"><h2>ข้อมูลส่วนตัว</h2></div><br><br> 

                            <form method="post" id="insert-form" name="insert-form">
                            <input type="hidden" id="id"  name="id"  >
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        รหัสนักศึกษา:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="std_id"  name="std_id" required class="form-control" autocomplete="off" minlength="9" placeholder="รหัสนักศึกษา" pattern="^[0-9]+$" title="กรอกรหัสนักศึกษา">
                                    </div>

                                    <div class="col-sm-1 control-label" class="form-control">
                                        รหัสผ่าน:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="password" id="std_password" name="std_password" required class="form-control" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="3" placeholder="ภาษาอังกฤษหรือตัวเลข">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        คำนำหน้า:
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="std_title_name" id="std_title_name" class="form-control" required>
                                            <option value="">เลือกข้อมูล</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                            <option value="ว่าที่ร้อยตรี">ว่าที่ร้อยตรี</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">

                                    <div class="col-sm-2 control-label">
                                        ชื่อ:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="std_name" id="std_name" required class="form-control" minlength="2" placeholder="ชื่อ">
                                    </div>
                               

                                    <div class="col-sm-1 control-label">
                                        นามสกุล:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="std_lastname" name="std_lastname" required class="form-control" minlength="2" placeholder="นามสกุล">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        เบอร์โทร:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="std_phone" name="std_phone" required class="form-control" placeholder="เบอร์มือถือ" maxlength="15">
                                    </div>
                     

                                    <div class="col-sm-1 control-label">
                                        อีเมล์:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="email" id="std_email" name="std_email" required class="form-control" placeholder="email">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        ที่อยู่:
                                    </div>
                                    <div class="col-sm-5">
                                        <textarea id="std_address" name="std_address" required placeholder="ที่อยู่" class="form-control"></textarea>
                                    </div>
                                </div>

                                <h4>ข้อมูลการศึกษา</h4>
                               
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        ระดับการศึกษา:
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="prog_id" name="prog_id" class="form-control" required>
                                            <option value="">เลือกข้อมูล</option>
                                            <option value="ระดับประกาศนียบัตรวิชาชีพ">-ระดับประกาศนียบัตรวิชาชีพ</option>
                                            <option value="ประกาศนียบัตรวิชาชีพชั้นสูง">-ประกาศนียบัตรวิชาชีพชั้นสูง</option>
                                            <option value="ปริญญาตรี">-ปริญญาตรี</option>
                                            <option value="บัณฑิตศึกษา">-บัณฑิตศึกษา</option>

                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group row mb-3">
                                <div class="col-sm-2 control-label" class="form-control">
                                        ปีที่เข้าเรียน:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text"  id="std_year_start" name="std_year_start" required minlength="4" maxlength="4" class="form-control" placeholder="พศ." pattern="^[0-9]+$" title="กรอกปี พศ.">
                                    </div>
                                    <div class="col-sm-1 control-label" class="form-control">
                                        ปีที่จบ:
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="std_year_complete"  name="std_year_complete" required minlength="4" maxlength="4" class="form-control" placeholder="พศ." pattern="^[0-9]+$" title="กรอกปี พศ.">
                                    </div>
                                </div>
                                <h4>ข้อมูลการทำงาน <font color="red">(*กรณียังไม่ได้ทำงาน ไม่ต้องกรอกข้อมูลส่วนนี้) </font>
                                </h4>
                               
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        ชื่อบริษัท:
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" id="std_company" name="std_company" class="form-control" placeholder="ชื่อบริษัท">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        เบอร์บริษัท:
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" id="std_compamy_phone"  name="std_compamy_phone"  class="form-control" placeholder="เบอร์บริษัท">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        ตำแหน่งงาน:
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" id="std_job_position" name="std_job_position" class="form-control" placeholder="ตำแหน่งงานในปัจจุบัน">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2 control-label">
                                        เงินเดือน (บาท):
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" id="std_job_salary" name="std_job_salary"  class="form-control" placeholder="เงินเดือน">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="submit" id="insert" value="Save" class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    <script type="text/javascript" src="../../pubilc/bootstrap/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="../../pubilc/bootstrap/js/bootstrap.min.js"></script>
</body>
<script src="../../pubilc/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>


<script>


var id = document.getElementById('user_id').value
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                console.log('data :>> ', data);
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
                $('#std_job_salary').val(data.std_job_salary.trim());
                $('#insert').val("บันทึก"); //เปลี่ยนข้อมความในปุ่ม insert เป็น Update
           
            }
        });



$(document).ready(function() {
   
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

 
 
});


</script>

</html>