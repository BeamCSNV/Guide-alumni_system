<!DOCTYPE html>

<head>
	<title>Marcelo Airan - GitHub</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<style>
		body {
			margin: 0;
			padding: 0;
			background-color: #f1f1f1;
		}

		.box {
			width: 1270px;
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-top: 25px;
		}
	</style>
</head>

<body>
	<div class="container box">
		<h1 align="center">จัดการสินค้า</h1>
		<br />
		<div class="table-responsive">
			<br />
			<div align="right">
				<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
			</div>
			<br /><br />
			<table id="user_data" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="10%">sid</th>
						<th width="35%">pt_id</th>
						<th width="35%">re_id</th>
						<th width="35%">pname</th>
						<th width="35%">p_detail</th>
						<th width="35%">qty</th>
						<th width="35%">p_price</th>
						<th width="10%">Edit</th>
						<th width="10%">Delete</th>
					</tr>
				</thead>
			</table>

		</div>
	</div>
</body>

</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Product</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="pid" name="pid" />
					<br>
					<label>sid</label>
					<input type="text" name="sid" id="sid" class="form-control" required />
					<br>
					<label>pt_id</label>
					<input type="text" name="pt_id" id="pt_id" class="form-control" required />
					<br>
					<label>re_id</label>
					<input type="text" name="re_id" id="re_id" class="form-control" required />
					<br>
					<label>pname</label>
					<input type="text" name="pname" id="pname" class="form-control" required />
					<br>
					<label>p_detail</label>
					<input type="text" name="p_detail" id="p_detail" class="form-control" required />
					<br>
					<label>qty</label>
					<input type="number" name="qty" id="qty" class="form-control" required />
					<br>
					<label>p_price</label>
					<input type="number" name="p_price" id="p_price" class="form-control" required />
					<br>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="operacao" id="operacao" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript">
	$(document).ready(function() {

		$('#add_button').click(function() {
			$('#user_form')[0].reset();
			$('.modal-title').text("เพิ่มสินค้า");
			$('#action').val("Add");
			$('#operacao').val("Add");
		});

		var dataTable = $('#user_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "buscar.php",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 3, 4],
				"orderable": false,
			}, ],
			"oLanguage": {
				"sProcessing": "กำลังประมวลผล...",
				"sZeroRecords": "ไม่พบผลลัพธ์",
				"sInfo": "กำลังแสดงตั้งแต่ _START_ ถึง _END_ จาก _TOTAL_ รายการ",
				"sInfoEmpty": "กำลังแสดง 0 ถึง 0 จาก 0 รายการ",
				"sInfoFiltered": "",
				"sInfoPostFix": "",
				"sSearch": "ค้นหา:",
				"sUrl": "",
				"oPaginate": {
					"sFirst": "อันดับแรก",
					"sPrevious": "ก่อนหน้า",
					"sNext": "ถัดไป",
					"sLast": "ล่าสุด"
				}
			},

		});

		$(document).on('submit', '#user_form', function(event) {
			event.preventDefault();
			console.log('user_form :>> ', $('#user_form').serialize());
			$.ajax({ //เรียกใช้ ajax
				url: "inserir_alterar.php",
				method: "post",
				data: $('#user_form')
					.serialize(),

				success: function(data) {
					console.log('data :>> ', data);
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 3000
					})
					$('#user_form')[0].reset()
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		});

		$(document).on('click', '.update', function() {
			var pid = $(this).attr("id");
			$.ajax({
				url: "busca_unica.php",
				method: "POST",
				data: {
					pid: pid
				},
				dataType: "json",
				success: function(data) {
					$('#userModal').modal('show');
					$('#pid').val(data.pid);
					$('#sid').val(data.sid);
					$('#pt_id').val(data.pt_id);
					$('#re_id').val(data.re_id);
					$('#pname').val(data.pname);
					$('#p_detail').val(data.p_detail);
					$('#qty').val(data.qty);
					$('#p_price').val(data.p_price);
					$('.modal-title').text("Edit User");
					$('#action').val("Edit");
					$('#operacao').val("Edit");
				}
			})
		});

		$(document).on('click', '.delete', function() {
			var pid = $(this).attr("id");
			if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้")) {
				$.ajax({
					url: "delete.php",
					method: "POST",
					data: {
						pid: pid
					},
					success: function(data) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Your work has been Delete',
							showConfirmButton: false,
							timer: 3000
						})
						dataTable.ajax.reload();
					}
				});
			} else {
				return false;
			}
		});



	});
</script>