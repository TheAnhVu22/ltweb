<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){

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
	<header> <h1>HT quản lý nhà cung cấp vận chuyển</h1> </header>
	<title> Trang chủ admin </title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="../all.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
</head>
<body>
<?php  include("../includes/menu_admin.php");?>

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
      <img class="d-block w-100" src="../Fileupload/blackpink 2.jpg" alt="Third slide">
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
			<h2>Danh sách nhà vận chuyển</h2>
			<hr>
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
			</tr>
			</thead>
                
				<tbody>
			<?php $i=1; while($mangdl1 = mysqli_fetch_array($kq2)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td><img src="<?php echo $mangdl1['anh'] ?>" alt="Card image cap" style="width: 100px; height: 100px;"></td>
				<td> <?php echo $mangdl1['nvc_ten']; ?> </td>
				<td> <?php echo $mangdl1['diachi']; ?> </td>
				<td> <?php echo $mangdl1['sdt']; ?> </td>
				<td> <?php echo $mangdl1['email']; ?> </td>
				<td> <?php echo $mangdl1['taikhoan']; ?> </td>

			</tr>
			<?php $i++; } ?>
		</tbody>
		</table>
	</div>

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
	<hr> 
	<div class="row">
	<div class="col-6">
		<h2>Bản đồ</h2>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14898.065398489516!2d105.77331552622722!3d21.012015876117395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acaacbd219c7%3A0xe19b302ae07c6203!2zTmfDtSAxNCBN4buFIFRyw6wgSOG6oSwgTeG7hSBUcsOsLCBOYW0gVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1637402540860!5m2!1svi!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
	<div class="col-6">
		<h2>Fanpage</h2>
		<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=394771788890681&autoLogAppEvents=1" nonce="9qWxtciX"></script>
<div class="fb-page" data-href="https://www.facebook.com/Realer-100155512433949" data-tabs="timeline" data-width="300" data-height="100" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Realer-100155512433949" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Realer-100155512433949">Realer</a></blockquote></div>
	</div>
	</div>
		</div>
		<hr>
	<?php include("../includes/footer.php") ?>
</body>
</html>