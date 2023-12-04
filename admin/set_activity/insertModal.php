<?php
include '../../config/conf.php';
try {
  $sql = "SELECT * FROM activity ORDER BY activity_id ASC";

  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}
 ?>

<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">จัดตารางกิจกรรม</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <label>ชื่อการจัดกิจกรรม</label>
                    <input type="hidden" id="event_list_id" name="event_list_id" />
                    <input type="text" name="event_list_name" id="event_list_name" class="form-control" required />
                    <br>
                    <label>ประเภทการจัดกิจกรรม</label>

                    <select id="hall" name="event_list_type" id="event_list_type" class="form-control" required>
                        <?php
                        if ($query->rowCount()>0) {
                            while ($data = $query -> fetch(PDO::FETCH_OBJ)) { ?>
                            <option value="<?=$data->activity_id;?>"><?=$data->activity_name;?> </option>
                        <?php }} ?>

                    </select>
                    <br>
                    <label>วันที่</label>
                    <input type="date" name="event_list_day" id="event_list_day" class="form-control" required />
                    <br>
                    <label>เวลาเริ่ม</label>
                    <input type="time" name="event_list_time" id="event_list_time" class="form-control" required />
                    <br>
                    <label>เวลาสิ้นสุด</label>
                    <input type="time" name="event_list_time_end" id="event_list_time_end" class="form-control" required />
                    <br>
                    <label>สถานที่</label>
                    <input type="text" name="event_list_loca" id="event_list_loca" class="form-control" required />
                    <br>
                    <label>ค่าใช้จ่าย</label>
                    <input type="number" name="charges" id="charges" class="form-control" value="0.0" />
                    <br>
                    <label>รายละเอียดเพิ่มเติม</label>
                    <textarea cols="10" rows="3" name="event_list_detali" id="event_list_detali" class="form-control" required ></textarea>
                    <br>
                    <label>รูปภาพ</label><br>
                    <img src="" width="180px" id="img_show" name="img_show">
                    
                    <input type="text" name="img_name" id="img_name" />
                    <input type="file" name="event_list_img" id="event_list_img" class="form-control" accept="image/*"   onchange="getImageValue()"/>
                    <br>
                    <input type="submit" id="insert" value="บันทึก" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default " id="close" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>
    function getImageValue() {
  // Get the file input element
  var input = document.getElementById("event_list_img");

  // Get the selected file
  var file = input.files[0];

  // Get the file name
  var fileName = file.name;

  // Get the file type
  var fileType = file.type;

  // Get the file size
  var fileSize = file.size;

  // Display the file name, type, and size
  console.log("Selected file name: " + fileName);
  console.log("Selected file type: " + fileType);
  console.log("Selected file size: " + fileSize);
  var objectUrl = URL.createObjectURL(file);

  // Set object URL as src attribute of img element
  var img = document.getElementById("img_show");
  img.src = objectUrl;
}

</script>