
<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ผู้ใช้งาน</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form"  name="insert-form" enctype="multipart/form-data">
                    <label>ชื่อ</label>
                    <input type="hidden" id="user_id" name="user_id" />
                    <input type="text" name="user_name" id="user_name" class="form-control" required />
                    <br>
                    <label>อีเมล</label>
                    <input type="text" name="user_email" id="user_email" class="form-control" required/>
                    <br>
                    <label>รหัสผ่าน</label>
                    <input type="password" name="user_pass" id="user_pass" class="form-control" required/>
                    <br>
                    <label>เบอร์โทร</label>
                    <input name="user_phone" id="user_phone" type="text"  class="form-control" />
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

<script type="text/javascript">

</script>