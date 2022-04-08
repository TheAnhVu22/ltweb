<?php
	include("includes/config.php");
	include("includes/kiemtra.php");

			$ten = $email = $sdt = $taikhoan = $matkhau =$diachi ="";
			$nameErr = $emailErr = $phoneErr = $usernameErr = $passwordErr = $tbloi= $addressErr="";
			$nameHolder = $emailHolder = $phoneHolder = $usernameHolder = $addressHolder="";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
					// xử lý ảnh
		$target_dir = "Fileupload/";
		$target_file= $target_dir . basename($_FILES["anh"]["name"]);
		$uploadOK=1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// kiểm tra có phải ảnh không
		if(isset($_POST["submit"])){
			$check = getimagesize($_FILES["anh"]["tmp_name"]);
			if($check !== false){
				// echo "file là ảnh - ".$check["mime"].".";
				$uploadOK=1;
			} else{
				// echo "không phải là ảnh";
				$uploadOK=0;
			}
		}
		// kiểm tra kích thước ảnh
		if($_FILES["anh"]["size"]>50000000){
			// echo "ảnh quá lớn!";
			$uploadOK=0;
		}
		// kiểm tra định dạng ảnh
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
			// echo "chỉ nhận file ảnh";
			$uploadOK=0;
		}
		//kiểm tra uploadOK
		if($uploadOK==0){
			// echo "lỗi, chưa tải được ảnh";
		}
		else{
			if(move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)){
			//	echo "file".basename($_FILES["anhavatar"]["name"])."đã được tải";
			} else{
				// echo "tải file thất bại";
			}
		}
		$anh ="../Fileupload/".basename($_FILES["anh"]["name"]);
		//xong phần xử lý ảnh	
					$nameHolder = $_POST['ten'];
					$kt_ten = validate_name($_POST['ten']);
					if($kt_ten == 1) {
						$ten = $_POST['ten'];
					}
					else{
						$nameErr = $kt_ten;
					}

					$emailHolder = $_POST['email'];
					$kt_email = validate_email($_POST['email']);
					if($kt_email == 1) {
						$email = $_POST['email'];
					}
					else {
						$emailErr = $kt_email;
					}
					
					$phoneHolder = $_POST['sdt'];
					$kt_sdt = validate_phone($_POST['sdt']);
					if($kt_sdt == 1) {
						$sdt = $_POST['sdt'];
					}
					else {
						$phoneErr = $kt_sdt;
					}
				
					$addressHolder = $_POST['diachi'];
					$diachi = $_POST['diachi'];
				
				
					$usernameHolder = $_POST['taikhoan'];
					$kt_taikhoan = validate_username($_POST['taikhoan']);
					if($kt_taikhoan == 1) {
						$taikhoan = $_POST['taikhoan'];
					}
					else{
						$usernameErr = $kt_taikhoan;
					}
				
					
					$kt_mk = validate_password($_POST['matkhau']);
					if($kt_mk == 1) {
						$matkhau = $_POST['matkhau'];
					}
					else {
						$passwordErr = $kt_mk;
					}
				

				if($ten != null && $email != null && $taikhoan != null && $matkhau != null && $diachi!= null && $sdt!=null && isset($_POST['vaitro'])) {
				$_SESSION['vaitro'] = $_POST['vaitro'];

				if($_SESSION['vaitro'] == "nhacungcap") {
					
					$dulieu = "INSERT INTO nhacungcap(ncc_ten,diachi,sdt,email,anh,taikhoan,matkhau) VALUES('$ten','$diachi','$sdt','$email','$anh','$taikhoan','$matkhau')";
					if(mysqli_query($con,$dulieu)) {
						echo "<script> alert(\"Đăng ký thành công\"); </script>";
						header('Refresh:0');
					}
					else {
						$tbloi = "Đăng ký không thành công";
					}
				}

				else if($_SESSION['vaitro'] == "nhavanchuyen") {
					$dulieu = "INSERT INTO nhavanchuyen(nvc_ten,diachi,sdt,email,anh,taikhoan,matkhau) VALUES('$ten','$diachi','$sdt','$email','$anh','$taikhoan','$matkhau')";
					if(mysqli_query($con,$dulieu)) {
						echo "<script> alert(\"Đăng ký thành công\"); </script>";
						header('Refresh:0');
					}
					else {
						$tbloi = "Đăng ký không thành công";
					}
				}
				
				}
				else {
					$tbloi = "Điền hết các trường";
				}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký</title>
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
		<header> <h1>Hệ thống quản lý nhà cung cấp và vận chuyển</h1> </header>
		<div class="container">
		
		<div class="row">
		<form action="" method="POST" enctype="multipart/form-data">
			<h1>Đăng ký</h1>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a7">Ảnh:</label></div>
				<div class="col-8"><input type="file" name="anh" class="form-control" id="a7" required>
				</div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a1">Tên (2-50 chữ):</label></div>
				<div class="col-8"><input type="text" name="ten" class="form-control" id="a1" required value="<?php echo $nameHolder; ?>">
				<?php echo $nameErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a2">Email:</label></div>
				<div class="col-8"><input type="text" name="email" class="form-control" id="a2" required value="<?php echo $emailHolder; ?>">
				<?php echo $emailErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a3">Địa chỉ:</label></div>
				<div class="col-8"><input type="text" name="diachi" class="form-control" id="a3" required value="<?php echo $addressHolder; ?>">
				<?php echo $addressErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a4">Số điện thoại (10 số):</label></div>
				<div class="col-8"><input type="text" name="sdt" class="form-control" id="a4" required value="<?php echo $phoneHolder; ?>">
				<?php echo $phoneErr; ?></div>
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a5">Tài khoản (5-14 ký tự):</label></div>
				<div class="col-8"><input type="text" name="taikhoan" class="form-control" id="a5" required value="<?php echo $usernameHolder; ?>">
				<?php echo $usernameErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a6">Mật khẩu (từ 5-30 ký tự):</label></div>
				<div class="col-8"><input type="text" name="matkhau" class="form-control" id="a6" required>
				<?php echo $passwordErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
			<div class="col-4"><label for="a1">Chọn vai trò:</label></div>
			<div class="col-8"><select class="custom-select" name="vaitro" required>
			  <option disabled selected>Chọn vai trò</option>
			  <option value="nhacungcap">Nhà cung cấp</option>
			  <option value="nhavanchuyen">Nhà vận chuyển</option>
			</select>
			</div>
			
			<input type="submit" name="btnsubmit" value="Đăng ký" class="btn btn-danger btndangky">
			<a href="index.php" class="btn btn-success  btndangky">Đăng nhập</a>
			<input type="reset" class="btn btn-info btndangky" value="Làm mới">
			<span class="error_message"> <?php echo $tbloi; ?> </span>
		</form>
		</div>
	</div>

<?php include("includes/footer.php") ?>
</body>
</html>