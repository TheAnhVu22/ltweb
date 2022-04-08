<?php
	require("../includes/config.php");
	include("../includes/kiemtra.php");
	session_start();
	
		if(isset($_SESSION['nhacungcap_login']) && $_SESSION['nhacungcap_login'] == true){

			$mancc = $_SESSION['ncc_ma'];
				$dulieu = "SELECT * FROM donhang,nguoidung WHERE donhang.mand=nguoidung.ma AND donhang.mancc = $mancc";
				$kq = mysqli_query($con,$dulieu);			
		
	}
		else {
			header('Location:../index.php');
		}	
?>

<!DOCTYPE html>
<html>
<head>
	<title> Danh sách đơn đặt hàng </title>
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
        "sLengthMenu":   "Xem _MENU_",
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
	<header> <h1>TRANG CHỦ NHÀ CUNG CẤP</h1> </header>
	<?php include("../includes/menu_nhacc.php") ?>
	
		<h1>Danh sách đơn đặt hàng</h1>

		<div class="container">
			
		
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx">
				 <thead>
			<tr>
				<th> Mã đơn hàng </th>
				<th>Tên người dùng</th>
				<th> Ngày đặt </th>
				<th> Tổng tiền </th>
				<th> Trạng thái NCC</th>
				<th> Trạng thái giao hàng</th>
				<th> Chi tiết </th>
				<th>Xác nhận</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while($mangdl = mysqli_fetch_array($kq)) { ?>
			<tr>
			
				<td> <?php echo $mangdl['dh_ma']; ?> </td>
				<td> <?php echo $mangdl['ten']; ?> </td>
				<td> <?php echo date("d-m-Y",strtotime($mangdl['ngay'])); ?> </td>
				<td> <?php echo $mangdl['tongtien']; ?> </td>
				<td>
					<?php
						if($mangdl['trangthai'] == 0) {
							echo "Đang chờ";
						}
						else {
							echo "Đã xác nhận";
						}
					?>
				</td>
			 	<td>
					<?php
						if($mangdl['giaohang'] == 0) {
							echo "Chưa giao";
						}
						else {
							echo "Đã giao hàng";
						}
					?>
				</td>
				<td> <a href="xemchitiet.php?id=<?php echo $mangdl['dh_ma']; ?>">Xem <i class="fas fa-chevron-circle-right"></i></a> </td>
				<td>
					<?php
						if($mangdl['trangthai'] == 0) {
							echo "<a href=\"xacnhan.php?id=".$mangdl['dh_ma']."\">Xác nhận</a>";
						}
						else {
							echo "Đã duyệt";
						}
					?>
				</td>
			</tr>
			<?php $i++; } ?>
			</tbody>
		</table>
	</div>

	</div>
	<?php include("../includes/footer.php") ?>
</body>
</html>