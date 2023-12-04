<!DOCTYPE html>
<html lang="en">
<?php

$data = [];
?>

<head>
    <meta http-equiv="Content-Tpye" Content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css" />
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" defer></script> -->
   <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css" />



  <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>



</head>

<body>
    
    <a href="index_news.php" id="back"> <img src="https://img.icons8.com/flat-round/64/000000/circled-left.png" width="50px" /></a>
    <div class="card">
        <div class="card-body">

            <form method="POST" action="repair_assessment_procrees.php" enctype="multipart/form-data">
                <span class="contact100-form-title">
                    รายงานกิจกรรม
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
            <tr align="center">
                <th>ชื่อการจัดกิจกรรม</th>
                <th>ประเภทการจัดกิจกรรม</th>
                <th>ค่าใช้จ่าย</th>
                <th>ลงทะเบียนทั้งหมด</th>
                <th>ลงทะเบียน(ยืนยันแล้ว)</th>
                <th>จำนวนเงินชำระ(ยืนยันแล้ว)</th>
                <th>รายได้ทั้งหมด</th>
                <!-- <th>ลงทะเบียน(ไม่มีการยืนยัน)</th> -->


            </tr>
        </thead>

        <!-- <tfoot>
                <tr>
                <th>ชื่อการจัดกิจกรรม</th>
                    <th>ประเภทการจัดกิจกรรม</th>
                    <th>จำนวนศิษย์เก่าที่ลงทะเบียน(ยืนยันแล้ว)</th>
                    <th>จำนวนศิษย์เก่าที่ลงทะเบียน(ไม่มีการยืนยันแล้ว)</th>
                    <th>จำนวนศิษย์เก่าที่ลงทะเบียนทั้งหมด</th>
                    <th>จำนวนเงินชำระที่ยืนยันแล้ว</th>
                    <th>ลงทะเบียนแต่ยังไม่ยืนยันการชำะเงิน</th>
                </tr>
            </tfoot> -->
    </table>

    <div class="card" align=center>
        <div class="card-body">

            <h3>ยอดศิษย์เก่าในการลงทะเบียน(ยืนยัน) จำนวน <span id="user_all_1">กำลังโหลด</span> คน </h3>
            <h3>ยอดเงินจากการลงทะเบียน จำนวน <span id="total_all_1">กำลังโหลด</span> บาท </h3>
        </div>
    </div>

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
            var date_start_title = ""
            var date_end_title = ""

            date_start_title = moment(date_start).format('YYYY-MM-DD');
                date_end_title = moment(date_end).format('YYYY-MM-DD');


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


            var title = "รายงานกิจกรรม "+ date_start_title+' - '+date_end_title

            $(document).ready(function() {
                $('#example').DataTable({
                    destroy: true,
                    data: dataSet,
                    columns: [{
                            title: 'ชื่อการจัดกิจกรรม'
                        },
                        {
                            title: 'ประเภทการจัดกิจกรรม'
                        },
                        {
                            title: 'ค่าใช้จ่าย'
                        },
                        {
                            title: 'ลงทะเบียนทั้งหมด'
                        },
                        {
                            title: 'ลงทะเบียน(ยืนยันแล้ว)'
                        },
                        {
                            title: 'ยืนยันการชำระเงิน'
                        },
                        {
                            title: 'รายได้ทั้งหมด'
                        },

                    ],
                    "dom": 'Bfrtip',
                    buttons: [
                            {
                                extend: 'print',
                                text: 'Print',
                                title: title,
                            },
                            {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            title: title,
                            }
                
                        ]
                        });
            });


            var dataSet = [];
            $.ajax({
                type: "POST",
                url: "./service/get_data_report.php",
                data: {
                    date_start: date_start,
                    date_end: date_end,
                    type: 'activity',
                },
                cache: false,
                success: function(response) {
                    // console.log('response :>> ', response);
                    dataSet = response.data
                    console.log('response.data :>> ', response.data);

                    console.log('dataSet :>> ', dataSet);
                    table = $('#example').DataTable();
                    table.clear();
                    table.rows.add(dataSet);
                    table.order([6, 'asc']);
                    table.buttons(['print' ]).container().appendTo('#example_wrapper .col-md-6:eq(0)');


                    table.draw();



                    document.getElementById("total_all_1").innerHTML = new Intl.NumberFormat("th-TH", {
                        style: 'currency',
                        currency: 'THB'
                    }).format(response.total_all_1);

                    document.getElementById("user_all_1").innerHTML = response.user_all_1;


                },
                dataType: "json"
            });







        }

        loaddata()
    </script>
    <style>
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        select {
            word-wrap: normal;
        }


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