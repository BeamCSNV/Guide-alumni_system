<?php
@session_start();
include 'condb/connect.php';
if (@$_SESSION['Userlevel'] != "") { ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    include_once "header.php";
    $data = [];
    ?>

    <head>
        <meta http-equiv="Content-Tpye" Content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="bootstrap/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" defer></script>
    </head>

    <body>


        <div class="card">
            <div class="card-body">

                <form method="POST" action="repair_assessment_procrees.php" enctype="multipart/form-data">
                    <span class="contact100-form-title">
                        รายงานรับซื้อรถ
                    </span>

                    <div class="form-group col-md-4">
                        <label for="province">เลือกช่วงวันที่</label>
                        <select name="date_select" id="date_select" class="form-control date_select">
                            <option value="1">7 วันย้อนหลัง</option>
                            <option value="2">1 เดือนย้อนหลัง</option>
                            <option value="3">2 เดือนย้อนหลัง</option>
                            <option value="4">3 เดือนย้อนหลัง</option>
                            <option value="5">1 ปี ย้อนหลัง</option>
                            <option value="6">ระบุวันที่</option>

                        </select>
                    </div>

                    <div class="form-group col-md-8">
                        <div id="set_date" style="display: none;">
                            <label for="ระบุวันที่">ระบุวันที่:</label>
                            <input type="date" id="date_start" name="date_start">
                            <label>ถึง</label>
                            <input type="date" id="date_end" name="date_end">


                        </div>
                    </div>
                    <div class="btn" onclick="loaddata()">
                        ยืนยัน
                    </div>
                </form>
            </div>
        </div>


        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ชื่อ-สกุล</th>
                    <th>เบอร์โทร</th>
                    <th>อาชีพ</th>
                    <th>ประเภทรถ</th>
                    <th>ยี่ห่อรถ</th>
                    <th>รุ่นรถ</th>
                    <th>ราคารถ</th>
                    <th>สีรถ</th>
                    <th>เลขไมล์</th>
                    <th>ทะเบียนรถ</th>
                    <th>รายละเอียด</th>
                    <th>วันที่ดำเนินการ</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>ชื่อ-สกุล</th>
                    <th>เบอร์โทร</th>
                    <th>อาชีพ</th>
                    <th>ประเภทรถ</th>
                    <th>ยี่ห่อรถ</th>
                    <th>รุ่นรถ</th>
                    <th>ราคารถ</th>
                    <th>สีรถ</th>
                    <th>เลขไมล์</th>
                    <th>ทะเบียนรถ</th>
                    <th>รายละเอียด</th>
                    <th>วันที่ดำเนินการ</th>
                </tr>
            </tfoot>
        </table>

        <div class="card" align=center>
            <div class="card-body">
                <h6>จำนวนรถที่รับซื้อ <span id="data_total">กำลังโหลด</span> คัน</h6>
                <h6>ยอดเงินจากเงินจากเงื่อนไข จำนวน <span id="total">กำลังโหลด</span> บาท </h6>
                <h6>ยอดเงินทั้งหมดที่รับซื้อมา จำนวน <span id="total_all">กำลังโหลด</span> บาท </h6>
            </div>
        </div>
        <script src="assets/jquery.min.js"></script>
        <script src="assets/script.js"></script>
        <script type="text/javascript">
            var date_end = moment().format('YYYY-MM-DD 00:00:00');
            var date_start = moment(date_end).subtract(7, 'd').format('YYYY-MM-DD 23:59:59');


            $(document).ready(function() {
                // ดึงค่าจาก class มาแสดงเมื่อมีการเปลี่ยนแปลง .change
                $(".date_select").change(function() {
                    var id = $(this).val();
                    if (id == "1") {
                        console.log("7 วันย้อนหลัง");
                        document.getElementById("set_date").style.display = "none";
                        date_end = moment().format('YYYY-MM-DD 00:00:00');
                        date_start = moment(date_end).subtract(7, 'd').format('YYYY-MM-DD 23:59:59');

                    }
                    if (id == "2") {
                        console.log("1 เดือนย้อนหลัง");
                        document.getElementById("set_date").style.display = "none";
                        date_end = moment().format('YYYY-MM-DD 00:00:00');
                        date_start = moment(date_end).subtract(1, 'M').format('YYYY-MM-DD 23:59:59');

                    }
                    if (id == "3") {
                        console.log("2 เดือนย้อนหลัง");
                        document.getElementById("set_date").style.display = "none";
                        date_end = moment().format('YYYY-MM-DD 00:00:00');
                        date_start = moment(date_end).subtract(2, 'M').format('YYYY-MM-DD 23:59:59');

                    }
                    if (id == "4") {
                        console.log("3 เดือนย้อนหลัง");
                        document.getElementById("set_date").style.display = "none";
                        date_end = moment().format('YYYY-MM-DD 00:00:00');
                        date_start = moment(date_end).subtract(3, 'M').format('YYYY-MM-DD 23:59:59');

                    }
                    if (id == "5") {
                        console.log("1 ปี ย้อนหลัง");
                        document.getElementById("set_date").style.display = "none";
                        date_end = moment().format('YYYY-MM-DD 00:00:00');
                        date_start = moment(date_end).subtract(1, 'Y').format('YYYY-MM-DD 23:59:59');

                    }
                    if (id == "6") {
                        console.log("ระบุ");
                        document.getElementById("set_date").style.display = "";
                        date_start = ''
                        date_end = ''

                    }
                });
            })


            function loaddata() {

                console.log('loaddata :>> ', );
                if (!date_start && !date_end) {
                    date_start = moment(document.getElementById("date_start").value).format('YYYY-MM-DD 00:00:00');
                    date_end = moment(document.getElementById("date_end").value).format('YYYY-MM-DD 23:59:59');
                }
                if (date_start === 'Invalid date' || date_end === 'Invalid date' || date_start === '' || date_end === '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'กรุณาระบุวันที่.',
                        })
                    }

                console.log('date_start :>> ', date_start);
                console.log('date_end :>> ', date_end);
                var dataSet = [];
                $.ajax({
                    type: "POST",
                    url: "get_data_report.php",
                    data: {
                        date_start: date_start,
                        date_end: date_end,
                        type: 'assessment',
                    },
                    cache: false,
                    success: function(response) {
                        console.log('response :>> ', response);
                        dataSet = response.data
                        console.log('dataSet :>> ', dataSet);
                        table = $('#example').DataTable();
                        table.clear();
                        table.rows.add(dataSet);
                        table.draw();

                        console.log('response.data_total :>> ', response.data_total);
                        document.getElementById("data_total").innerHTML = response.data_total;

                        document.getElementById("total").innerHTML = new Intl.NumberFormat("th-TH", {
                            style: 'currency',
                            currency: 'THB'
                        }).format(response.total);

                        document.getElementById("total_all").innerHTML = new Intl.NumberFormat("th-TH", {
                            style: 'currency',
                            currency: 'THB'
                        }).format(response.total_all);


                    },
                    dataType: "json"
                });
                // var dataSet = [
                //     ['Tiger Nixon', 'System Architect', 'Edinburgh', '5421', '2011/04/25', '$320,800','Tiger Nixon', 'System Architect', 'Edinburgh', '5421', '2011/04/25', '$320,800'],
                //   ];

                $(document).ready(function() {
                    $('#example').DataTable({
                        destroy: true,
                        data: dataSet,
                        columns: [{
                                title: 'ชื่อ-สกุล'
                            },
                            {
                                title: 'เบอร์โทร'
                            },
                            {
                                title: 'อาชีพ'
                            },
                            {
                                title: 'ประเภทรถ'
                            },
                            {
                                title: 'ยี่ห่อรถ'
                            },
                            {
                                title: 'รุ่นรถ'
                            },
                            {
                                title: 'ราคารถ'
                            },
                            {
                                title: 'สีรถ'
                            },
                            {
                                title: 'เลขไมล์'
                            },
                            {
                                title: 'ทะเบียนรถ'
                            },
                            {
                                title: 'รายละเอียด'
                            },
                            {
                                title: 'วันที่'
                            },
                        ],
                    });
                });
                console.log('DataTable :>> ', );

            }

            loaddata()
        </script>
        <style>
             body {
                margin: 20px;
            }
            #example_wrapper {
                padding: 20px;
            }

            .btn {
                display: inline-block;
                font-weight: 400;
                color: #fff;
                text-align: center;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-color: #5f9ea0;
                border: 1px solid #000;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }
        </style>

    </body>

    </html>
<?php } else {
    echo "<script>";
    echo "alert('คุณไม่มีสิทธิ์เข้าถึงลิงค์นี้');";
    echo "window.location='index.html'";

    echo "</script>";
} ?>