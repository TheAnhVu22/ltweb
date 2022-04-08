<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['nhacungcap_login']) && $_SESSION['nhacungcap_login'] == true){
			$ncc_ma= $_SESSION['ncc_ma'];

			$dulieu = "SELECT * FROM sanpham WHERE sanpham.mancc=$ncc_ma";
			$kq = mysqli_query($con,$dulieu);

			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(isset($_POST['ma'])) {
					$ma = $_POST['ma'];
						$xoa = "DELETE FROM sanpham WHERE sp_ma='$ma'";
						$kiemtra = mysqli_query($con,$xoa);
					if(!$kiemtra) {
						echo "<script> alert(\"Xóa không thành công\"); </script>";
						header('Refresh:0');
					}
					else {
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
	<title> Danh sách sản phẩm </title>
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
	<header> <h1>TRANG CHỦ NHÀ CUNG CẤP</h1> </header>
	<?php include("../includes/menu_nhacc.php") ?>
	<div class="container">
		<h1> Danh sách sản phẩm</h1>
		<hr>
		<a href="sanpham_them.php" class="btn btn-success">Thêm mới <i class="far fa-plus-square"></i></a>
		<form action="" method="POST" class="form">
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
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
			</thead>                
				<tbody>
			<?php $i=1; while($mangdl = mysqli_fetch_array($kq)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td><img class="card-img-top img-fluid" src="<?php echo $mangdl['anh'] ?>" alt="Card image cap" style="width: 100px; height: 100px;"></td>
				<td> <?php echo $mangdl['sp_ten']; ?> </td>

				<td> <?php echo $mangdl['loai']; ?> </td>
				<td> <?php echo $mangdl['soluong']; ?> </td>
				<td> <?php echo $mangdl['gia']; ?> </td>
				
				<td> <?php echo $mangdl['mota']; ?> </td>
				<td> <a href="sanpham_sua.php?id=<?php echo $mangdl['sp_ma']; ?>"><i class="fas fa-edit"></i></a> </td>
				<td><input type="submit" class="btn btn-danger" name="ma" value="<?php echo $mangdl['sp_ma']; ?>"></td>
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