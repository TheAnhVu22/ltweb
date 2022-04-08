<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['nhacungcap_login'])&&$_SESSION['nhacungcap_login'] == true){

			$dsNCC = "SELECT * FROM nhacungcap";
			$kqNCC = mysqli_query($con,$dsNCC);
			
			$dsNCC1 = "SELECT * FROM nhacungcap ORDER BY thongke DESC LIMIT 3";
			$kqNCC1 = mysqli_query($con,$dsNCC1);

			$ds2 = "SELECT * FROM nhavanchuyen";
			$kq2 = mysqli_query($con,$ds2);
			// tính toán thống kê.
			 $i=1; 
			 while($mangdl = mysqli_fetch_array($kqNCC)) { 
					 $mancc = $mangdl['ncc_ma'];
					 $dsDH = "SELECT * FROM donhang WHERE donhang.mancc='$mancc'";
					$kqDH = mysqli_query($con,$dsDH); 
				if(isset($_POST['chonkieu'])&&!empty($_POST['chonkieu'])) {
					$ketqua=0;
					$kieu = $_POST['chonkieu'];
				if($kieu=="soluong"){
					 $x=1; 
					 while($mangdl3 = mysqli_fetch_array($kqDH)) { 
					$ketqua+="1"; 
					$x++; }
				}
				else{
					$x=1; 
					 while($mangdl3 = mysqli_fetch_array($kqDH)) { 
					$ketqua+=$mangdl3['tongtien']; 
					$x++; }
				}
				mysqli_query($con,"UPDATE nhacungcap SET thongke = '$ketqua' WHERE ncc_ma='$mancc'")or die(mysqli_error());
				$i++;
				header('Refresh:0');
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
	<header> <h1>TRANG CHỦ NHÀ CUNG CẤP</h1> </header>
	<title> Trang chủ nhà cung cấp </title>
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
	<?php  include("../includes/menu_nhacc.php");?>
	<div id="slides" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#slides" data-slide-to="0" class="active"></li>
    <li data-target="#slides" data-slide-to="1"></li>
    <li data-target="#slides" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" style="height:700px">
    <div class="carousel-item active">
      <img class="d-block w-100" src="../Fileupload/band.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="../Fileupload/blackpink.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="w-100" src="../Fileupload/blackpink 2.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slides" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
		<div class="container">	
			<hr>
			<h2>TOP 3 NHÀ CUNG CẤP VÀNG:</h2>
			<hr>
			<!-- chọn kiểu thống kê -->			
			<form action="" method="POST">
			<fieldset class="form-group row">
			<label for="a2">Chọn kiểu thống kê: </label>
			<div class="input-box">
			<select class="custom-select" name="chonkieu" id="chonkieu">
			  	<option value="soluong">Tổng số đơn</option>
				<option value="tongtien">Tổng tiền</option>
			</select>	
			</div>
			<input type="submit" class="btn btn-success" value="Xem">
			</fieldset>
			</form>
			<!--  end form chọn kiểu thống kê -->
			<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-dark">
				 <thead>
				<tr>
					<th>STT</th>
					<th>ẢNH</th>
					<th>TÊN</th>
					<th>ĐỊA CHỈ</th>
					<th>SĐT</th>
					<th>EMAIL</th>
					<th>TÀI KHOẢN</th>
					<th>Số đơn / Tổng tiền</th>
				</tr>
				</thead>                
				<tbody>
				<!-- thống kê -->
				

				<!-- hiển thị danh sách -->
				<?php $j=1; while($mangdl1 = mysqli_fetch_array($kqNCC1)) { ?>
				<tr>
					<td> <?php echo $j; ?> </td>
					<td><img class="card-img-top img-fluid" src="<?php echo $mangdl1['anh'] ?>" alt="Card image cap" style="width: 100px; height: 100px;"></td>
					<td> <?php echo $mangdl1['ncc_ten']; ?> </td>
					<td> <?php echo $mangdl1['diachi']; ?> </td>
					<td> <?php echo $mangdl1['sdt']; ?> </td>
					<td> <?php echo $mangdl1['email']; ?> </td>
					<td> <?php echo $mangdl1['taikhoan']; ?> </td>
					<td>
					<?php echo $mangdl1['thongke']; ?>
					</td>
				<!-- end tính -->
				</tr>
				<?php $j++; } ?>
			</tbody>
			</table>
			</div>  <!-- end top 3 nhà cung câp -->
			<hr>
	<h2>Ban giám đốc</h2>
	<div class="card-deck">
		<div class="card">
			<img class="card-img-top" src="../Fileupload/lợnquay.jpg" alt="Card image cap">
			<div class="card-body">
				<h4 class="card-title">Vũ Thế Anh</h4>
				<p class="card-text">Chủ tịch hội đồng quản trị</p>
				<p class="card-text"><small class="text-muted">B18DCCN043</small></p>
			</div>
		</div>
		<div class="card">
			<img class="card-img-top" src="../Fileupload/gà.jpg" alt="Card image cap">
			<div class="card-body">
				<h4 class="card-title">Vũ Thế Anh</h4>
				<p class="card-text">Chủ tịch hội đồng quản trị</p>
				<p class="card-text"><small class="text-muted">B18DCCN043</small></p>
			</div>
		</div>
		<div class="card">
			<img class="card-img-top" src="../Fileupload/pizza.jpg" alt="Card image cap">
			<div class="card-body">
				<h4 class="card-title">Vũ Thế Anh</h4>
				<p class="card-text">Chủ tịch hội đồng quản trị</p>
				<p class="card-text"><small class="text-muted">B18DCCN043</small></p>
			</div>
		</div>
	</div>
		</div>
		<hr>
	<?php include("../includes/footer.php") ?>
</body>
</html>