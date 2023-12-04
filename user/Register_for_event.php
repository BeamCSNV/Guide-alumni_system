<?php @session_start();

include '../config/conf.php';
try {
    $sql = "SELECT * FROM event_list ";
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
    <title>ลงทะเบียนเข้าร่วมกิจกรรม</title>
    <link href="../pubilc/css/from.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</head>

<body>
    <div class="container">
        <div class="title">ลงทะเบียนเข้าร่วมกิจกรรม</div>
        <form method="POST" action="repair_assessment_procrees.php" enctype="multipart/form-data">


            <div class="user__details">
                <div class="input__box">
                    <span class="details">เลือกกิจกกรรมที่จะเข้าร่วม</span>
                    <select name="event" id="event" class="form-control event" required>
                        <?php while ($data = $query->fetch(PDO::FETCH_OBJ)) { ?>
                            <option value="<?= $data->event_list_id; ?>"><?= $data->event_list_name; ?></option>
                        <?php } ?>


                    </select>
                </div>

                <div class="input__box">
                    <span class="details">ชื่อ</span>
                    <input readonly name="first_name" id="first_name" type="text" placeholder="สมศักดิ์" required>
                </div>
                <div class="input__box">
                    <span class="details">นามสกุล</span>
                    <input readonly name="last_name" id="last_name" type="text" placeholder="ทองดี" required>
                </div>
                <div class="input__box">
                    <span class="details">อายุ</span>
                    <input readonly name="first_age" id="first_age" type="tel" placeholder="25" required>
                </div>

                <div class="input__box">
                    <span class="details">อาชีพ</span>
                    <input readonly name="career" id="career" type="text" placeholder="อาจารย์" required>
                </div>

                <div class="input__box">
                    <span class="details">ที่อยู่ลูกค้า</span>
                    <input readonly name="address" id="address" type="text" placeholder="192/1 ต.เมือง อ.เมือง จ.ขอนแก่น 40000" required>
                </div>
                <div class="input__box">
                    <span class="details">เบอร์โทรศัพท์</span>
                    <input readonly name="phone" type="tel" id="phone" placeholder="0123456789" required>
                </div>
                <div class="input__box">
                    <span class="details">CUS_PRICE</span>
                    <input name="cus_price" type="tel" id="cus_price" placeholder="9999" required>
                </div>


            </div>
            <div class="gender__details">
                <span class="gender__title">ข้อมูลการประเมิน</span>
            </div>
            <div class="user__details">



                <div class="input__box">
                    <span class="details">วัน/เดือน/ปี</span>
                    <input name="datetime" type="date" placeholder="วัน/เดือน/ปี">
                </div>


                <div class="input__box">
                    <span class="details">ราคา</span>
                    <input name="price" type="tel" placeholder="9999" required>
                </div>


                <div class="input__box">
                    <span class="details">รายละเอียดการซ่อม</span>
                    <input name="detail" type="text" placeholder="รายละเอียดการซ่อม" required>
                </div>
                <div class="input__box">
                    <span class="details">ลักษณะรถ</span>
                    <select name="type_id" id="province" class="form-control type_id" required>
                        <option value="">เลือกรถ</option>
                        <?php while ($result = mysqli_fetch_assoc($typecar)) : ?>
                            <option value="<?= $result['type_id'] ?>"><?= $result['type_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="input__box">
                    <span class="details">ยี่ห้อของรถ</span>
                    <select name="b_id" id="amphure" class="form-control b_id">
                        <option value="">เลือกยี่ห้อของรถ</option>
                    </select>
                </div>
                <div class="input__box">
                    <span class="details">รุ่นของรถ</span>
                    <select name="district_id" id="district" class="form-control district_id">
                        <option value="">เลือกรุ่นของรถ</option>
                    </select>
                </div>
                <div class="input__box">
                    <span class="details">ราคามาตราฐานของรถ</span>
                    <select name="price_id" id="price_id" class="form-control price_id">
                        <option value="">โปรดเลือก</option>
                    </select>
                </div>
                <div class="input__box">
                    <span class="details">รูปภาพ</span>
                    <div class="file-input">
                        <input type="file" name="uploaded_file" id="file-input" class="file-input__input" />
                        <label class="file-input__label" for="file-input">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                            </svg>
                            <span>Upload file</span></label>
                    </div>
                </div>

            </div>


            <div class="button">
                <input type="submit" value="บันทึก">
            </div> <br>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // ดึงค่าจาก class มาแสดงเมื่อมีการเปลี่ยนแปลง .change
            $(".event").change(function() {
                // เอา id ของ select option จาก database มาเก็๋บในตัวแปลง id
                var id = $(this).val();
                // ส่งค่า id ไป
                var dataString = 'event_id=' + id;
                console.log('event_id :>> ', id);
                $.ajax({
                        type: "POST",
                        url: "get_event_list.php",
                        data: dataString,
                        cache: false,
                        success: function(respons) {
                            console.log('respons :>> ', respons);
                            // console.log('address :>> ', respons.address);
                            // console.log('career :>> ', respons.career);
                            // console.log('first_age :>> ', respons.first_age);
                            // console.log('first_name :>> ', respons.first_name);
                            // console.log('last_name :>> ', respons.last_name);
                            // console.log('phone :>> ', respons.phone);
                            // document.getElementById("address").value = respons.address;
                            // document.getElementById("career").value = respons.career;
                            // document.getElementById("first_age").value = respons.first_age;
                            // document.getElementById("first_name").value = respons.first_name;
                            // document.getElementById("last_name").value = respons.last_name;
                            // document.getElementById("phone").value = respons.phone;
                            // document.getElementById("cus_price").value = respons.cus_price;
                        },
                        dataType: "json"
                    });


            });
        })
    </script>

</body>

</html>