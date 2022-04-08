<?php
	require("../includes/config.php");
	include("../includes/kiemtra.php");
	error_reporting(0);
	session_start();
	
		if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){
			//mã người dùng
			$mand = $_SESSION['ma'];

				$dulieudonhang = "SELECT * FROM donhang,nhacungcap,nhavanchuyen WHERE mand='$mand'AND donhang.manvc=nhavanchuyen.nvc_ma AND donhang.mancc=nhacungcap.ncc_ma";
				$ketqua = mysqli_query($con,$dulieudonhang);

			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(isset($_POST['madh'])) {
					$madh = $_POST['madh'];
					$dulieu = "SELECT trangthai FROM donhang WHERE dh_ma='$madh'";
					$kq=mysqli_query($con,$dulieu);
					$mangdl = mysqli_fetch_array($kq);
					$kt= $mangdl['trangthai'];
					if($kt == 0){
						$xoa = "DELETE FROM donhang WHERE dh_ma='$madh'";
						$kiemtra = mysqli_query($con,$xoa);

					if(!$kiemtra) {
						echo "<script> alert(\"Hủy không thành công\"); </script>";
						 header('Refresh:0');
					}
					else {
						header('Refresh:0');
					}
					 } else{
						echo "<script> alert(\"Hủy không thành công, do đơn đã được xác nhận\"); </script>";
						 header('Refresh:0');
					 }
					
				}
			}
		
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
        "sLengthMenu":   "Xem _MENU_",
        "sZeroRecords":  "Không tìm thấy kết quả nào phù hợp",
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
	
		<h1>Danh sách đặt hàng</h1>

		<div class="container">
			<a href="dathang_them.php" class="btn btn-success">Thêm mới <i class="far fa-plus-square"></i></a>
		<form action="" method="POST">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx">
				 <thead>
			<tr>
				<th> Mã đơn hàng </th>
				<th> Ngày đặt </th>
				<th> Tổng tiền </th>
				<th>Nhà cung cấp</th>
				<th>Nhà vận chuyển</th>
				<th> Trạng thái NCC</th>
				<th> Trạng thái NVC</th>
				<th> Chi tiết </th>
				<th>Hủy đơn</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while($danhsachdonhang = mysqli_fetch_array($ketqua)) { ?>
			<tr>
			
				<td> <?php echo $danhsachdonhang['dh_ma']; ?> </td>
				
				<td> <?php echo date("d-m-Y",strtotime($danhsachdonhang['ngay'])); ?> </td>
				<td> <?php echo $danhsachdonhang['tongtien']; ?> </td>
				<td> <?php echo $danhsachdonhang['mancc']." : ".$danhsachdonhang['ncc_ten']; ?> </td>
				<td> <?php echo $danhsachdonhang['manvc']." : ".$danhsachdonhang['nvc_ten']; ?> </td>
				<td>
					<?php
						if($danhsachdonhang['trangthai'] == 0) {
							echo "Đang chờ";
						}
						else {
							echo "Đã xác nhận";
						}
					?>
				</td>
			 	<td>
					<?php
						if($danhsachdonhang['giaohang'] == 0) {
							echo "Chưa giao";
						}
						else {
							echo "Đã giao hàng";
						}
					?>
				</td>
				<td> <a href="xemchitiet.php?id=<?php echo $danhsachdonhang['dh_ma']; ?>">Xem <i class="fas fa-chevron-circle-right"></i></a> </td>
				<td><input type="submit" class="btn btn-danger" name="madh" value="<?php echo $danhsachdonhang['dh_ma']; ?>"></td>
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
