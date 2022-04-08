<?php
	include("../includes/config.php");
	session_start();
if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){
	//lấy mã nhà cung cấp
			$ma = $_GET['id'];
			$dulieusanpham = "SELECT * FROM sanpham WHERE sanpham.mancc = '$ma'";
			$kqsanpham = mysqli_query($con,$dulieusanpham);	

			$dulieuNCC = "SELECT * FROM nhacungcap WHERE ncc_ma='$ma'";
			$kqNCC = mysqli_query($con,$dulieuNCC);
			$mangdl1 = mysqli_fetch_array($kqNCC);

			$dulieudon ="SELECT * FROM donhang WHERE donhang.mancc='$ma'";
			$sldon = mysqli_query($con,$dulieudon);
			$ten = $email = $sdt = $diachi = $anh="";
		
		}
		else {
			header('Location:../index.php');
		}
?>
<!DOCTYPE html>
<html>
<head>
	<header> <h1>HT quản lý nhà cung cấp vận chuyển</h1> </header>
	<title> Chi tiết nhà cung cấp </title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="../all.css" >
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
    $('#xxx').DataTable();
} );
</script>
</head>
<body>
	<?php  include("../includes/menu_admin.php");?>
		<div class="container">
			<h2>Thông tin nhà cung cấp</h2>
			<hr>
			<div class="row">
			<div class="col-lg-4">
				<img class="card-img-top" src="<?php echo $mangdl1['anh'] ?>" alt="Card image cap"style="width: 280px; height:300px;" >
			</div>
			<div class="col-8">
			<table class="table table-dark">
				<tr>
					<td>
						<h4>Tên:</h4>
					</td>
					<td>
						<h4><?php echo $mangdl1['ncc_ten'] ?></h4>
					</td>			
				</tr>
				<tr>
					<td>
						<h4>Địa chỉ:</h4>
					</td>
					<td>
						<h4><?php echo $mangdl1['diachi'] ?></h4>
					</td>			
				</tr>
				<tr>
					<td>
						<h4>SĐT:</h4>
					</td>
					<td>
						<h4><?php echo $mangdl1['sdt'] ?></h4>
					</td>			
				</tr>
				<tr>
					<td>
						<h4>Email:</h4>
					</td>
					<td>
						<h4><?php echo $mangdl1['email'] ?></h4>
					</td>			
				</tr>
				<?php 
				$dem=0;
				 ?>
				 <?php $i=1; while($mangdl2 = mysqli_fetch_array($sldon)) { ?>
				 	<?php $dem=$i; ?>
				 <?php $i++; } ?>
				<tr>
					<td>
						<h4>Số đơn:</h4>
					</td>
					<td>
						<h4><?php echo $dem ?></h4>
					</td>			
				</tr>
			</table>
			</div>
			</div>
			<hr>
			<div class="row">
				<h2>Danh sách sản phẩm của nhà cung cấp</h2>
				
			<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx">
				 <thead>
				<tr>
					<th>STT</th>
					<th>ẢNH</th>
					<th>TÊN</th>
					<th>LOẠI</th>
					<th>SỐ LƯỢNG</th>
					<th>GIÁ</th>
					<th>CHI TIẾT</th>
				</tr>
				</thead>                
				<tbody>
				<?php $i=1; while($mangdl = mysqli_fetch_array($kqsanpham)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td> <img src="<?php echo $mangdl['anh'] ?>" alt="" class="img-fluid img"style="width: 100px; height: 100px;"> </td>
					<td> <?php echo $mangdl['sp_ten']; ?> </td>
					<td> <?php echo $mangdl['loai']; ?> </td>
					<td> <?php echo $mangdl['soluong']; ?> </td>
					<td> <?php echo $mangdl['gia']; ?> </td>
					<td> <?php echo $mangdl['mota']; ?> </td>
				</tr>
				<?php $i++; } ?>
			</tbody>
			</table>
			</div>
			</div>
		</div>
			
	<?php include("../includes/footer.php") ?>
</body>
</html>