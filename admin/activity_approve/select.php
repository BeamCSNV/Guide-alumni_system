<?php
$id = $_POST['id'];
include '../../config/conf.php';
$opt = '';
try {

    $sql = "SELECT
    activity_register.id,
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
    alumni.std_company,
    alumni.std_compamy_phone,
    alumni.std_job_position,
    alumni.std_job_salary,
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
    INNER JOIN activity ON event_list.event_list_type=activity.activity_id
    WHERE activity_register.id='$id'";

    $query = $conn->prepare($sql);
    $query->execute();
} catch (\Exception$e) {
    echo "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage();
}

$opt .= '<div class="table-responsive">
<table class="table table-bordered">';
while ($row = $query->fetch(PDO::FETCH_OBJ)) {

    $opt .= '<tr>
              <td><lable>ข้อมูลศิษย์เก่า</lable></td>
              <td>' .
    $row->std_title_name . ' ' . $row->std_name . ' ' . $row->std_lastname .
    ' <br> เบอร์โทร :' . $row->std_phone .
    ' <br> อีเมล :' . $row->std_email .
    ' <br> ที่อยู่ :' . $row->std_address . '<br>' .
    $row->prog_id . ' ปีการศึกษา ' . $row->std_year_start . '-' . $row->std_year_complete .
    ' <br> ที่ทำงาน:' . $row->std_company . ' เบอร์โทร:' . $row->std_compamy_phone . ' ตำแหน่ง:' . $row->std_job_position . ' เงินเดือน:' . $row->std_job_salary . ' บาท. <br>'
        . '</td>
            </tr>';
    $opt .= '<tr>
              <td><lable>รายละเอียดกิจกรรม</lable></td>
              <td>' .

    'ประเภท ' . $row->activity_name . 'กิจกรรม ' . $row->event_list_name . '<br>' .
    'วันที่:' . $row->event_list_day .
    'เวลา:' . $row->event_list_time . -$row->event_list_time_end . ' น. <br>' .
    'สถานที่:' . $row->event_list_loca . '<br>' .
    'ค่าใช้จ่าย ' . $row->charges . ' บาท.<br>' .
    'รายละเอียดดังนี้:' . $row->event_list_detali . '<br> <br>' .
    ' <div align=center>
                  <img style="  border-radius: 5px;" src="../../pubilc/image/upload/' . $row->img_name . '" width="480px" id="" name="">
              </div>'

        . '</td>
            </tr>';

            if($row->status_payment == 1) { 
    $opt .= '<tr style="background-color: green; color:#fff;" >
            <td><lable>สถานะ</lable></td>
            <td>ยืนยันการชำระเงิน</td>
            </tr>';}else{
              $opt .= '<tr style="background-color: red;color:#fff;">
              <td><lable>สถานะ</lable></td>
              <td >ยังไม่ยืนยันการชำระเงิน</td>
              </tr>';
            }
            if($row->payment_url) { 
    $opt .= '<tr>
            <td><lable>สลิป</lable></td>
            <td>' .
    ' <div align=center>
            <img style="  border-radius: 5px;" src="../../pubilc/image/upload/' . $row->payment_url . '" width="480px" id="" name="">
        </div>'
        . '</td>
            </tr>';}
}
$opt .= '</table></div>';
echo $opt;
