<?php
	include("../includes/config.php");
	include("../includes/kiemtra.php");
	session_start();
	$matkhaumoi =$xacnhan="";
	if(isset($_SESSION['nhacungcap_login']) && $_SESSION['nhacungcap_login'] == true){
		$thongbao = $mkcu = $tb ="";
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			$ma = $_SESSION['ncc_ma'];
				$matkhau = $_POST['matkhaucu'];
				$dulieu = "SELECT matkhau FROM nhacungcap WHERE matkhau='$matkhau' AND ncc_ma='$ma'";
				$kq = mysqli_query($con,$dulieu);
				$mangdl = mysqli_fetch_array($kq);
				if($mangdl) {
					
					$kt_mk = validate_password($_POST['matkhaumoi']);
					if($kt_mk == 1) {
						$matkhaumoi = $_POST['matkhaumoi'];
						$xacnhan = $_POST['xacnhan'];
					}					
						
						//so sánh 2 chuỗi có phân biệt chữ hoa chữ thường
						if(strcmp($matkhaumoi,$xacnhan) == 0 && $matkhaumoi != null) {
							$capnhat = "UPDATE nhacungcap SET matkhau='$xacnhan' WHERE ncc_ma='$ma'";
							if(mysqli_query($con,$capnhat)) {
								echo "<script> alert(\"Đổi mật khẩu thành công\"); </script>";
								header("Refresh:0");
							}
							else {
								$thongbao = "Thất bại";
							}
						}
						else {
							$tb = "Mật khẩu không giống nhau/ sai định dạng";
						}
					
				}
				else {
					$mkcu = "Mật khẩu cũ bị sai";
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
	<title> Đổi mật khẩu</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="../all.css" >
	<link rel="stylesheet" href="../dangnhap.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
</head>
<body>
	<header> <h1>TRANG CHỦ NHÀ CUNG CẤP</h1></header> 
	<?php include("../includes/menu_nhacc.php") ?>
	
		<div class="container">	
		<div class="row">
		<form method="POST" >
			<h1>Đổi mật khẩu</h1>
			<hr>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a1">Mật khẩu cũ:</label></div>
				<div class="col-8"><input type="password" name="matkhaucu" class="form-control" id="a1" required>
				<span class="error_message"><?php echo $mkcu; ?></span></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a2">Mật khẩu mới:</label></div>
				<div class="col-8"><input type="password" name="matkhaumoi" class="form-control" id="a2" required>
				</div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a3">Nhập lại:</label></div>
				<div class="col-8"><input type="password" name="xacnhan" class="form-control" id="a3" required>
				<span class="error_message"><?php echo $tb; ?></span></div>	
			</fieldset>
		
			<input type="submit" value="Đổi mật khẩu" class="submit_button btn btn-success" />
			<input type="reset" class="btn btn-info" value="Làm mới">
			 <span class="error_message"> <?php echo $thongbao; ?></span>
		</form>
	</div>
</div>
<?php include("../includes/footer.php") ?>
</body>
</html>