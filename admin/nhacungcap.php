<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){
			$dulieu = "SELECT * FROM nhacungcap";
			$kq = mysqli_query($con,$dulieu);
	}
	else {
		header('Location:../index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Danh sách nhà cung cấp </title>
	<link rel="stylesheet" href="../all.css" >
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
  	
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
 	<script>
    $(document).ready(function() {
     
    // Cấu hình các nhãn phân trang
    $('#xxx,#xxx1').dataTable( {
        "language": {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
            }
        }
    } );
         
    } ); 
  </script>   
 	<script>
$(document).ready( function () {
    $('#xxx, #xxx1').DataTable();
} );
</script>
</head>
<body>
	<header> <h1>HT quản lý nhà cung cấp vận chuyển</h1> </header>
	<?php include("../includes/menu_admin.php") ?>
	<div class="container">
		<h1> Danh sách nhà cung cấp</h1>
		<a href="#them" data-toggle="modal" class="btn btn-success">Thêm mới <i class="far fa-plus-square"></i></a>
		<?php include('nhacungcap_them.php'); ?>
		<form action="" method="POST" enctype="multipart/form-data">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx">
				 <thead>
			<tr>
				<th>STT</th>
				<th>ẢNH</th>
				<th>TÊN</th>
				<th>ĐỊA CHỈ</th>
				<th>SĐT</th>
				<th>EMAIL</th>
				<th>TÀI KHOẢN</th>
				<th>Xem chi tiết</th>
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while($mangdl = mysqli_fetch_array($kq)) { ?>
			<tr>
				<?php $ma=$mangdl['ncc_ma']; ?>
				<td> <?php echo $i; ?> </td>
				<td><img class="card-img-top img-fluid" src="<?php echo $mangdl['anh'] ?>" alt="Card image cap" style="width: 100px; height: 100px;"></td>
				<td> <?php echo $mangdl['ncc_ten']; ?> </td>
				<td> <?php echo $mangdl['diachi']; ?> </td>
				<td> <?php echo $mangdl['sdt']; ?> </td>
				<td> <?php echo $mangdl['email']; ?> </td>
				<td> <?php echo $mangdl['taikhoan']; ?> </td>
				<td> <a href="chitietncc.php?id=<?php echo $mangdl['ncc_ma']; ?>">Xem <i class="fas fa-chevron-circle-right"></i></a> </td>
				<td> <a href="nhacungcap_sua.php?id=<?php echo $mangdl['ncc_ma']; ?>"><i class="fas fa-edit"></i></a> </td>
<td><a href="#xoa<?php echo $ma; ?>" data-toggle="modal"  class="btn btn-danger"><i class="fas fa-trash"></i></a>
<?php include('nhacungcap_xoa.php'); ?></td>
			</tr>
			<?php $i++; } ?>
			</tbody>
		</table>
		</div>
		</form>
	</div>

	<?php include("../includes/footer.php") ?>
</body>
</html>