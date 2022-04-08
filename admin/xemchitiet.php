<?php
	require("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){
			$dh_ma = $_GET['id'];

			$sql = "SELECT *,sanphamdat.soluong as soluong FROM donhang,sanphamdat,sanpham WHERE sanphamdat.madh='$dh_ma' AND sanphamdat.masp=sanpham.sp_ma AND sanphamdat.madh=donhang.dh_ma";
			$ketqua = mysqli_query($con,$sql);

			$sql2 = "SELECT * FROM donhang,nhavanchuyen,nhacungcap WHERE dh_ma='$dh_ma'AND donhang.manvc=nhavanchuyen.nvc_ma AND donhang.mancc=nhacungcap.ncc_ma";
			$kq = mysqli_query($con,$sql2);
			$mangdl = mysqli_fetch_array($kq);
		}
		else {
			header('Location:../index.php');
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Xem chi tiết đơn hàng</title>
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
    $('#xxx').dataTable( {
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
    $('#xxx').DataTable();
} );
</script>
</head>
<body>
	<header> <h1>HT quản lý nhà cung cấp vận chuyển</h1> </header>
	<?php include("../includes/menu_admin.php") ?>
	<div class="container">
		<h1>Xem chi tiết đơn hàng</h1>
		<table class="table table-responsive table-hover table-dark">
		<tr>
			<td> Mã đơn hàng: </td>
			<td> <?php echo $dh_ma; ?> </td>
			<td>Nhà cung cấp:</td>
			<td> <?php echo $mangdl['ncc_ma']." : ".$mangdl['ncc_ten']; ?> </td>
		</tr>
		<tr>
			<td> Trạng thái NCC: </td>
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
			<td>Nhà vận chuyển:</td>
			<td> <?php echo $mangdl['nvc_ma']." : ".$mangdl['nvc_ten']; ?> </td>
		</tr>
		<tr>
			<td> Trạng thái vận chuyển: </td>
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
			<td> Ngày: </td>
			<td> <?php echo date("d-m-Y",strtotime($mangdl['ngay'])); ?> </td>
		</tr>
		<tr>
			<td> Địa chỉ: </td>
			<td> <?php echo $mangdl['diachi'] ?> </td>
		</tr>
		</table>
		<form action="" method="POST" class="form">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx">
				<thead>
			<tr>
				<th>Ảnh</th>
				<th> Tên sản phẩm </th>
				<th> Giá </th>
				<th> Số lượng </th>
				<th> Thành tiền </th>
			</tr>
			</thead>
			<tbody>
			<?php $i=1; while($danhsachsanpham = mysqli_fetch_array($ketqua)) { ?>
			<tr>
				<td><img class="card-img-top img-fluid" src="<?php echo $danhsachsanpham['anh'] ?>" alt="Card image cap" style="width: 100px; height: 100px;"></td>
				<td> <?php echo $danhsachsanpham['sp_ten']; ?> </td>
				<td> <?php echo $danhsachsanpham['gia']; ?> </td>
				<td> <?php echo $danhsachsanpham['soluong']; ?> </td>
				<td> <?php echo $danhsachsanpham['soluong']*$danhsachsanpham['gia']; ?> </td>
			</tr>
		</tbody>
		<tbody>
			<?php $i++; } ?>
			<tr style="height:40px;vertical-align:bottom;">
				<td colspan="4" style="text-align:right;"> Tổng tiền: </td>
				<td>
				<?php
					mysqli_data_seek($ketqua,0);
					$danhsachsanpham = mysqli_fetch_array($ketqua);
					echo $danhsachsanpham['tongtien'];
				?>
				</td>
			</tr>
			</tbody>
		</table>
		</div>	
		</form>
	
		</div>
		<hr>
	<?php
		include("../includes/footer.php");
	?>
</body>
</html>