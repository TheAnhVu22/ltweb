<?php
	include("../includes/config.php");
	include("../includes/kiemtra.php");
			$ten = $email = $sdt = $taikhoan = $matkhau =$diachi ="";
			$nameErr = $emailErr = $phoneErr = $usernameErr = $passwordErr = $tbloi= $addressErr="";
			$nameHolder = $emailHolder = $phoneHolder = $usernameHolder = $addressHolder="";
			if (isset($_POST['btnsubmit1'])){
				// xử lý ảnh
		$target_dir = "../Fileupload/";
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
				

				if($ten != null && $email != null && $taikhoan != null && $matkhau != null && $diachi!= null && $sdt!=null ) {
					$dulieu = "INSERT INTO nhacungcap(ncc_ten,diachi,sdt,email,anh,taikhoan,matkhau) VALUES('$ten','$diachi','$sdt','$email','$anh','$taikhoan','$matkhau')";
					if(mysqli_query($con,$dulieu)) {
						echo "<script> alert(\"Đăng ký thành công\"); </script>";
						 header('Refresh:0');
					}
					else {
						echo "<script> alert(\"Đăng ký không thành công\"); </script>";
					}
				}
				else {
					echo "<script> alert(\"Sai định dạng\"); </script>";
				}
		}
?>
	<div class="modal fade" id="them" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form action="" method="POST" enctype="multipart/form-data">
			<h1>Thêm nhà cung cấp</h1>
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
				<div class="col-4"><label for="a5">Tài khoản (5-14 ký tự chữ hoặc số):</label></div>
				<div class="col-8"><input type="text" name="taikhoan" class="form-control" id="a5" required value="<?php echo $usernameHolder; ?>">
				<?php echo $usernameErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a6">Mật khẩu (từ 5-30 ký tự):</label></div>
				<div class="col-8"><input type="text" name="matkhau" class="form-control" id="a6" required>
				<?php echo $passwordErr; ?></div>	
			</fieldset>
			
			
			<button name="btnsubmit1" type="submit" class="btn btn-success">Thêm</button>
			<input type="reset" class="btn btn-info" value="Làm mới">
			
		</form>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
      
      </div>
    </div>
  </div>
</div>