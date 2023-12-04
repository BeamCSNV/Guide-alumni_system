<div class="modal fade" id="addModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">รายชื่อศิษย์เก่า</h4>
            </div>
            <div class="modal-body">
               


                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <form method="post" id="insert-form" name="insert-form">
                            <h4>ข้อมูลส่วนตัว</h4>
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
                                        <input type="number" id="std_job_salary" name="std_job_salary"  class="form-control" placeholder="เงินเดือน" min="0">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default " id="close" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content {
        width: 780px;
    }
</style>