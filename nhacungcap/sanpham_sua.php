<?php
	include("../includes/config.php");
	include("../includes/kiemtra.php");
	session_start();
	if(isset($_SESSION['nhacungcap_login']) && $_SESSION['nhacungcap_login'] == true){
			$ma = $_GET['id'];
			$dulieu = "SELECT * FROM sanpham WHERE sp_ma='$ma'";
			$kq = mysqli_query($con,$dulieu);
			$mangdl = mysqli_fetch_array($kq);
			$ten = $loai = $soluong = $gia = $mancc  =$mota= "";
			$nameErr = $loaiErr = $giaErr = $soluongErr =  $tbloi  = "";
			$nameHolder = $loaiHolder = $soluongHolder = $giaHolder = $addressHolder="";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				
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
		$anh = basename($_FILES["anh"]["name"]);

		//kiểm tra có ảnh không
		if($anh){ //nếu có tải ảnh mới
			$anh ="../Fileupload/".basename($_FILES["anh"]["name"]);
		
		} else{ //nếu không thì lấy ảnh cũ
			$anh = $_POST['anh2']; 
			
		}
		//xong phần xử lý ảnh
					$nameHolder = $_POST['ten'];
					
						$ten = $_POST['ten'];

					$loaiHolder = $_POST['loai'];				
						$loai = $_POST['loai'];
					
					$soluongHolder = $_POST['soluong'];
					$kt_sl = validate_number($_POST['soluong']);
					if($kt_sl == 1) {
						$soluong = $_POST['soluong'];
					}
					else {
						$soluongErr = $kt_sl;
					}
				
					$giaHolder = $_POST['gia'];
					$resultValidate_price = validate_price($_POST['gia']);
					if($resultValidate_price == 1) {
						$gia = $_POST['gia'];
					}
					else {
						$giaErr = $resultValidate_price;
					}
					$mota = $_POST['mota'];
				if($ten != null && $loai != null && $soluong != null && $gia != null) {
					$capnhat = "UPDATE sanpham SET sp_ten='$ten',loai='$loai',soluong='$soluong',mota='$mota',gia='$gia',anh='$anh' WHERE sp_ma='$ma'";
					if(mysqli_query($con,$capnhat)) {
						header('Refresh:0;url=index.php');
					}
					else {
						$tbloi = "Cập nhật thất bại";
					}
				}
				else {
					$tbloi = "Không được để trống";
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
	<title> Sửa thông tin sản phẩm </title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width initial-scale=1">
	<link rel="stylesheet" href="../dangnhap.css">
	<link rel="stylesheet" href="../all.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
</head>
<body>
<header> <h1>TRANG CHỦ NHÀ CUNG CẤP</h1> </header>
<?php  include("../includes/menu_nhacc.php");?>
		<div class="container">
		<div class="row">
		<form action="" method="POST" enctype="multipart/form-data">
			<h1>Sửa thông tin</h1>

			<div class="row">
								<label for="anh" class="col-sm-4 form-control-label text-right">Ảnh đại diện:</label>
							<div class="col-sm-8">
								<div class="row">
									<div class="col-sm-6">
										<img src="<?php echo $mangdl['anh'] ?>" alt="" class="img-fluid img">
									</div>
								</div>
								<!-- lấy link ảnh đại diện -->
								<input type="text" name="anh2" value="<?= $mangdl['anh'] ?>">

								<input name="anh" type="file" class="form-control" placeholder="tải ảnh">
							</div>
						</div>

			<fieldset class="form-group row">
				<div class="col-4"><label for="a1">Tên sản phẩm:</label></div>
				<div class="col-8"><input type="text" name="ten" class="form-control" id="a1" required value="<?php echo $mangdl['sp_ten']; ?>">
				<span class="error_message"><?php echo $nameErr; ?></span>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a2">Loại:</label></div>
				<div class="col-8"><input type="text" name="loai" class="form-control" id="a2" required value="<?php echo $mangdl['loai']; ?>">
				<?php echo $loaiErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a3">Số lượng:</label></div>
				<div class="col-8"><input type="text" name="soluong" class="form-control" id="a3" required value="<?php echo $mangdl['soluong']; ?>">
				</div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a4">Giá:</label></div>
				<div class="col-8"><input type="text" name="gia" class="form-control" id="a4" required value="<?php echo $mangdl['gia']; ?>">
				<?php echo $giaErr; ?></div>
			</fieldset>	
			<fieldset class="form-group row">
				<div class="col-4"><label for="a5">Mô tả:</label></div>
				<div class="col-8"><input type="text" name="mota" class="form-control" id="a5" required value="<?php echo $mangdl['mota']; ?>">
				
			</fieldset>			
			<input type="submit" value="Cập nhật" class="submit_button btn btn-success" /> 
			<input type="reset" class="btn btn-info" value="Làm mới">
			<span class="error_message"> <?php echo $tbloi; ?> </span>
		</form>
		</div>
	</div>

	<?php include("../includes/footer.php") ?>
</body>
</html>