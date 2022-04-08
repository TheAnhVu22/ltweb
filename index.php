<?php
	include('includes/config.php');

	$thongbao = $tb="";
	if(isset($_POST['btnsubmit'])) {
		if(!empty($_POST['taikhoan']) && !empty($_POST['matkhau']) && isset($_POST['vaitro'])){
			session_start();

			$taikhoan = $_POST['taikhoan'];
			$matkhau = $_POST['matkhau'];
			$_SESSION['vaitro'] = $_POST['vaitro'];

			if($_SESSION['vaitro'] == "nhacungcap") {
				$dulieu = "SELECT ncc_ma,taikhoan,matkhau FROM nhacungcap WHERE taikhoan='$taikhoan' AND matkhau='$matkhau'";
				$kq = mysqli_query($con,$dulieu);
				$mangdl = mysqli_fetch_array($kq);
				if($mangdl) {
					$_SESSION['ncc_ma'] =  $mangdl['ncc_ma'];
					
					$_SESSION['sessUsername'] = $_POST['taikhoan'];
					$_SESSION["nhacungcap_login" ] = true;
					 header('Location:nhacungcap/index.php');
				}
				else {
					$thongbao = "tài khoản hoặc mật khẩu không chính xác";
				}
			}

			else if($_SESSION['vaitro'] == "nhavanchuyen") {
				$dulieu1 = "SELECT nvc_ma,taikhoan,matkhau FROM nhavanchuyen WHERE taikhoan='$taikhoan' AND matkhau='$matkhau'";
				$kq = mysqli_query($con,$dulieu1);
				$mangkq = mysqli_fetch_array($kq);
				if($mangkq) {
					$_SESSION['nvc_ma'] =  $mangkq['nvc_ma'];
					$_SESSION['sessUsername'] = $_POST['taikhoan'];
					$_SESSION['nhavanchuyen_login'] = true;
					 header('Location:nhavanchuyen/index.php');
				}
				else {
					$thongbao = "tài khoản hoặc mật khẩu không chính xác";
				}
			}

			else if($_SESSION['vaitro'] == "admin") {
				$dulieu = "SELECT ma,taikhoan,matkhau FROM nguoidung WHERE taikhoan='$taikhoan' AND matkhau='$matkhau'";
				$kq = mysqli_query($con,$dulieu);
				$mangkq = mysqli_fetch_array($kq);		
					if($mangkq) {
						$_SESSION['admin_login'] = true;
						$_SESSION['ma'] =  $mangkq['ma'];
						$_SESSION['sessUsername'] = $_POST['taikhoan'];						
						header('Location:admin/index.php');
					}
					else {
						$thongbao = "Sai thông tin";
					}
				}
			}
		 else {
		 	$tb = "chọn vai trò!";
		 }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Đăng nhập </title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="dangnhap.css">
	<link rel="stylesheet" href="all.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
</head>
<body>
	<header> <h1>HT quản lý nhà cung cấp vận chuyển</h1> </header>
	<div class="container">
		
		<div class="row dangnhap">
			
		
			<form action="" method="POST">
				<h1>Đăng nhập</h1>
				<hr>
			<fieldset class="form-group">
				<label for="a1">Tên tài khoản:</label>
				<input type="text" name="taikhoan" class="form-control" id="a1" required>
			</fieldset>
			<fieldset class="form-group">
				<label for="a2">Mật khẩu:</label>
				<input type="password" name="matkhau" class="form-control" id="a2" required>
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-3"><label for="a2">Vai trò:</label></div>
			<div class="col-5">
				<select class="custom-select" name="vaitro" required>
			  <option disabled selected>Chọn vai trò</option>
			  <option value="admin">admin</option>
			  <option value="nhacungcap">Nhà cung cấp</option>
			  <option value="nhavanchuyen">Nhà vận chuyển</option>
			</select>
			</div>
			</fieldset>
			<input type="submit" name="btnsubmit" value="Đăng nhập" class="btn btn-success nut">
			<a href="dangky.php" class="btn btn-danger nut" >Đăng ký</a>
			 <?php echo $thongbao; echo $tb?>

		</form>
		</div>
	</div>
<?php include("includes/footer.php") ?>
</body>
</html>