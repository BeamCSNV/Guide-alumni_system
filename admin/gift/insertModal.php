
<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">ของที่ระลึก</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form"  name="insert-form" enctype="multipart/form-data">
                    <label>ชื่อ</label>
                    <input type="hidden" id="gift_id" name="gift_id" />
                    <input type="text" name="gift_name" id="gift_name" class="form-control" required />
                    <br>
                    <label>ราคา</label>
                    <input type="number" name="gift_price" id="gift_price" class="form-control" />
                    <br>
                    <label>รายละเอียด</label>
                    <input type="text" name="gift_detail" id="gift_detail" class="form-control" />
                    <br>
                    <label>รูปภาพ</label>
                    <input name="gift_image" id="gift_image" type="hidden"  class="form-control" />
                    <input type="file" id="fileAjax" name="fileAjax" accept="image/x-png,image/gif,image/jpeg" /><br /><br />
                   
                    <br>
                    <input type="submit" id="insert" value="Save" class="btn btn-success" />
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