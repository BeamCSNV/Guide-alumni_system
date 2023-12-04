<div class="modal fade" id="addModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">หลักสูตร</h4>
      </div>
      <div class="modal-body" >
        <form method="post" id="insert-form">
          <label>ข้อมูลหลักสูตร</label>
          <input type="hidden" id="course_id" name="course_id" />
          <input type="text" name="course_name" id="course_name" class="form-control" required />
          <br>
          <input type="submit" id="insert" value="บันทึก" class="btn btn-success" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default "id="close"  data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
