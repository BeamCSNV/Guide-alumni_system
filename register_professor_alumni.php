<?php
include 'config/conf.php';
try {
  $sql = "SELECT * FROM course";
  $query = $conn->prepare($sql);
  $query->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <title>ฟอร์มเพิ่มข้อมูลศิษย์เก่า</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
  <script>
    const queryString = window.location.search;
    console.log('queryString');
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    var register = urlParams.get('register')
    console.log('register :>> ', register);

    if (register == 'succes') {
      console.log('if');
      Swal.fire({
        title: 'สำเร็จ',
        text: 'สมัครสมาชิกสำเร็จ',
        icon: 'success',


      });
    } else {
      console.log('else');

    }
  </script>
  <?php include('index.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-primary" role="alert">
          <h5>ลงทะเบียนข้อมูลศิษย์เก่า มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขต ขอนแก่น</h5>
        </div>
        <form action="admin/professor_alumni/insert.php" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              รหัสนักศึกษา:
            </div>
            <div class="col-sm-2">
              <input type="text" name="std_id" required class="form-control" autocomplete="off" minlength="9" placeholder="รหัสนักศึกษา" pattern="^[0-9]+$" title="กรอกรหัสนักศึกษา">
              <input type="hidden" name="form_index" class="form-control" value="form_index">
            </div>

            <div class="col-sm-1 control-label" class="form-control">
              รหัสผ่าน:
            </div>
            <div class="col-sm-2">
              <input type="password" name="std_password" required class="form-control" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="3" placeholder="ภาษาอังกฤษหรือตัวเลข">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              คำนำหน้า:
            </div>
            <div class="col-sm-2">
              <select name="std_title_name" class="form-control" required>
                <option value="">เลือกข้อมูล</option>
                <option value="นาย">นาย</option>
                <option value="นาง">นาง</option>
                <option value="นางสาว">นางสาว</option>
                <option value="ว่าที่ร้อยตรี">ว่าที่ร้อยตรี</option>
              </select>
            </div>

            <div class="col-sm-1 control-label">
              ชื่อ:
            </div>
            <div class="col-sm-2">
              <input type="text" name="std_name" required class="form-control" minlength="2" placeholder="ชื่อ">
            </div>

            <div class="col-sm-1 control-label">
              นามสกุล:
            </div>
            <div class="col-sm-2">
              <input type="text" name="std_lastname" required class="form-control" minlength="2" placeholder="นามสกุล">
            </div>
          </div>

          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              เบอร์โทร:
            </div>
            <div class="col-sm-3">
              <input type="text" name="std_phone" required class="form-control" placeholder="เบอร์มือถือ" maxlength="15">
            </div>

            <div class="col-sm-1 control-label">
              อีเมล์:
            </div>
            <div class="col-sm-3">
              <input type="email" name="std_email" required class="form-control" placeholder="email">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              ที่อยู่:
            </div>
            <div class="col-sm-5">
              <textarea name="std_address" required placeholder="ที่อยู่" class="form-control"></textarea>
            </div>
          </div>

          <h5>ข้อมูลการศึกษา</h5>
          <hr>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              ระดับการศึกษา:
            </div>
            <div class="col-sm-3">
              <select name="prog_id" class="form-control" required>
                <option value="">เลือกข้อมูล</option>
                <?php
                if ($query->rowCount() > 0) {
                  $i = 1;
                  while ($data = $query->fetch(PDO::FETCH_OBJ)) {
                ?>
                    <option value="<?=$data->course_name;?>">-<?=$data->course_name;?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="col-sm-2 control-label" class="form-control">
              ปีที่เข้าเรียน:
            </div>
            <div class="col-sm-2">
              <input type="text" name="std_year_start" required minlength="4" maxlength="4" class="form-control" placeholder="พศ." pattern="^[0-9]+$" title="กรอกปี พศ.">
            </div>
            <div class="col-sm-1 control-label" class="form-control">
              ปีที่จบ:
            </div>
            <div class="col-sm-2">
              <input type="text" name="std_year_complete" required minlength="4" maxlength="4" class="form-control" placeholder="พศ." pattern="^[0-9]+$" title="กรอกปี พศ.">
            </div>
          </div>
          <h5>ข้อมูลการทำงาน <font color="red">(*กรณียังไม่ได้ทำงาน ไม่ต้องกรอกข้อมูลส่วนนี้) </font>
          </h5>
          <hr>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              ชื่อบริษัท:
            </div>
            <div class="col-sm-5">
              <input type="text" name="std_company" class="form-control" placeholder="ชื่อบริษัท">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              เบอร์บริษัท:
            </div>
            <div class="col-sm-4">
              <input type="text" name="std_compamy_phone" class="form-control" placeholder="เบอร์บริษัท">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              ตำแหน่งงาน:
            </div>
            <div class="col-sm-4">
              <input type="text" name="std_job_position" class="form-control" placeholder="ตำแหน่งงานในปัจจุบัน">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-sm-2 control-label">
              เงินเดือน (บาท):
            </div>
            <div class="col-sm-3">
              <input type="number" name="std_job_salary" class="form-control" placeholder="เงินเดือน" min="0">
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-3">

              <button type="submit" class="btn btn-primary">สมัครเป็นศิษย์เก่า</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <hr>
  <br> <br> <br> <br> <br>
</body>

</html>