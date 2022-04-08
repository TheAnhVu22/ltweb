<?php
	include("../includes/config.php");
	include("../includes/kiemtra.php");
	session_start();
if(isset($_SESSION['nhacungcap_login']) && $_SESSION['nhacungcap_login'] == true){
			$dulieu = "SELECT ncc_ma FROM nhacungcap";
			
			$kq = mysqli_query($con,$dulieu);
			
			$ten = $loai = $ncc = $soluong = $gia = $mota = "";
			$ma= $_SESSION['ncc_ma'];
			$dl_ten = "SELECT ncc_ten From nhacungcap WHERE ncc_ma='$ma'";
			$mangdl = mysqli_query($con,$dl_ten);
			$kq1 = mysqli_fetch_array($mangdl);
			$tenncc = $kq1['ncc_ten'];
			$tenErr = $loaiErr =$slErr= $requireErr = $confirmMessage = $giaErr = "";
			$nameHolder = $priceHolder = $descriptionHolder =$slHolder = $loaiHolder ="";
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
		$anh ="../Fileupload/".basename($_FILES["anh"]["name"]);
		//xong phần xử lý ảnh	
					$nameHolder = $_POST['ten'];
					$ten = $_POST['ten'];

					$priceHolder = $_POST['gia'];
					$resultValidate_price = validate_price($_POST['gia']);
					if($resultValidate_price == 1) {
						$gia = $_POST['gia'];
					}
					else {
						$giaErr = $resultValidate_price;
					}
					$loaiHolder = $_POST['loai'];
					$loai = $_POST['loai'];

					$resultValidate_sl = validate_number($_POST['soluong']);
					if($resultValidate_sl == 1) {
						$soluong = $_POST['soluong'];
					}
					else {
						$slErr = $resultValidate_sl;
					}
				// if(isset($_POST['mancc'])) {
				// 	$ncc = $_POST['mancc'];
				// }
				
				// if(empty($_POST['soluong'])) {
				// 	$soluong = "";
				// }
				// else {
				// 	if($_POST['soluong'] == 1) {
				// 		$rdbStock = 1;
				// 	}
				// 	else if($_POST['rdbStock'] == 2) {
				// 		$rdbStock = 2;
				// 	}
				// }
					$mota = $_POST['mota'];

				if($ten != null && $gia != null && $loai != null && $soluong != null) {
					// $rdbStock = 0;
					$them = "INSERT INTO sanpham(sp_ten,mota,loai,soluong,gia,anh,mancc) VALUES('$ten','$mota','$loai','$soluong','$gia','$anh','$ma')";
					if(mysqli_query($con,$them)) {
						header('Refresh:0;url=index.php');
					}
					else {
						$requireErr = "Adding Product Failed";
					}
			}
				// else if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 2) {
				// 		$query_addProduct = "INSERT INTO products(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category',NULL)";
				// 	if(mysqli_query($con,$query_addProduct)) {
				// 		echo "<script> alert(\"Product Added Successfully\"); </script>";
				// 		header('Refresh:0');
				// 	}
				// 	else {
				// 		$requireErr = "Adding Product Failed";
				// 	}
				// }
				else {
					$requireErr = "* All Fields are Compulsory with valid values except Description";
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
	<title>Thêm sản phẩm</title>
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
			<h1>Thêm sản phẩm</h1>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a1">Tên sản phẩm:</label></div>
				<div class="col-8"><input type="text" name="ten" class="form-control" id="a1" required value="<?php echo $nameHolder; ?>">
				<?php echo $tenErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a6">Ảnh sản phẩm:</label></div>
				<div class="col-8"><input type="file" name="anh" class="form-control" id="a6" required value="<?php echo $nameHolder; ?>">
				</div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a2">Loại:</label></div>
				<div class="col-8"><input type="text" name="loai" class="form-control" id="a2" required value="<?php echo $loaiHolder; ?>">
				<?php echo $loaiErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a3">Số lượng:</label></div>
				<div class="col-8"><input type="text" name="soluong" class="form-control" id="a3" required value="<?php echo $slHolder; ?>">
				<?php echo $slErr; ?></div>	
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a4">Giá:</label></div>
				<div class="col-8"><input type="text" name="gia" class="form-control" id="a4" required value="<?php echo $priceHolder; ?>">
				<?php echo $giaErr; ?></div>
			</fieldset>
			
			<fieldset class="form-group row">
				<div class="col-4"><label for="a4">Nhà cung cấp:</label></div>
				
				<div class="col-8"><input type="text" name="mancc" class="form-control" id="a4" disabled value="<?php echo $ma ?>">
					<?php echo $tenncc; ?>
				</div>
				
			</fieldset>
			<fieldset class="form-group row">
				<div class="col-4"><label for="a4">Mô tả:</label></div>
				<div class="col-8"><input type="text" name="mota" class="form-control" id="a4" required value="<?php echo $descriptionHolder; ?>">
				</div>
			</fieldset>
			
			<input type="submit" name="btnsubmit" value="Thêm" class="btn btn-success btndangky">
			<input type="reset" class="btn btn-info" value="Làm mới">
			<span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> </span>
		</form>
		</div>
	</div>

<?php include("../includes/footer.php") ?>
</body>
</html>