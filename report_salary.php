<!DOCTYPE html>
<html lang="en">


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
                รายงานเงินเดือน
                </span>

                <!-- <div class="form-group col-md-4">
                    <label for="province">เลือกช่วงวันที่</label>
                    <select name="date_select" id="date_select" class="form-control date_select">
                        <option value="1">น้อยกว่า 10,000</option>
                        <option value="2">10,000 - 20,000</option>
                        <option value="3">20,000- 25,000</option>
                        <option value="4">25,000 - 30,000</option>
                        <option value="5">มากว่า 30,000</option>
                       

                    </select>
                </div>

                
                <div class="btn" onclick="loaddata()">
                    ยืนยัน
                </div> -->
            </form>
        </div>
    </div>


    <table id="example" class="display" style="width:100%">
        <thead>
            <tr align="center">
                <th>เงินเดือน</th>
                <th>ศิษย์เก่า</th>
            </tr>
        </thead>

       
    </table>

    

    <script type="text/javascript">
         var salary_start = 0 ;
         var salary_end = 10000;
        

        $(document).ready(function() {
            // ดึงค่าจาก class มาแสดงเมื่อมีการเปลี่ยนแปลง .change
            $(".date_select").change(function() {
                var id = $(this).val();
                if (id == "1") {
                    
                    salary_start = 0 ;
                    salary_end = 10000;

                }
                if (id == "2") {
                    
                    salary_start = 10001 ;
                    salary_end = 20000;
                }
                if (id == "3") {
                   
                    salary_start = 20001;
                    salary_end = 25000;

                }
                if (id == "4") {
                    
                    salary_start = 25001 ;
                    salary_end = 3000;

                }
                if (id == "5") {
                   
                    salary_start = 30001 ;
                    salary_end = 1000000000;

                }
                
            });
        })


        function loaddata() {
           console.log('loaddata :>> ', salary_start+' - '+salary_end);

            $(document).ready(function() {
                $('#example').DataTable({
                    destroy: true,
                    data: dataSet,
                    columns: [{
                            title: 'เงินเดือน'
                        },
                        {
                            title: 'ศิษย์เก่า'
                        },

                    ],
                    "dom": 'Bfrtip',
                    buttons: [
                            {
                                extend: 'print',
                                text: 'Print',
                                title: 'รายงานเงินเดือน',
                            },
                            {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            title: 'รายงานเงินเดือน',
                            }
                
                        ]
                        });
            });


            var dataSet = [];
            console.log('ajax');
            $.ajax({
                type: "POST",
                url: "./service/get_data_report.php",
                data: {
                    salary_start: salary_start,
                    salary_end: salary_end,
                    type: 'salary',
                },
                cache: false,
                success: function(response) {
                    console.log('response :>> ', response);
                    dataSet = response.data
                    console.log('response.data :>> ', response.data);

                    console.log('dataSet :>> ', dataSet);
                    table = $('#example').DataTable();
                    table.clear();
                    table.rows.add(dataSet);
                    table.order([0, 'asc']);
                    table.buttons(['print' ]).container().appendTo('#example_wrapper .col-md-6:eq(0)');


                    table.draw();



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