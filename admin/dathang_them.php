<?php
	require("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){
			 // lấy danh sách nhà cung cấp
			$dulieu = "SELECT ncc_ma,ncc_ten FROM nhacungcap ORDER BY ncc_ma ASC";
			$kq = mysqli_query($con,$dulieu);
			// lấy danh sách nhà vận chuyển
			$dulieu2 = "SELECT nvc_ma,nvc_ten FROM nhavanchuyen ORDER BY nvc_ma ASC";
			$kq2 = mysqli_query($con,$dulieu2);
			$kt=0;
			if($_SERVER['REQUEST_METHOD'] == "POST") {		if(isset($_POST['chonncc'])) {
				if(!empty($_POST['chonncc'])){
						$kt=1;
						$nccma = $_POST['chonncc'];
						$dulieu1 = "SELECT *,sanpham.anh AS anh FROM sanpham,nhacungcap WHERE nhacungcap.ncc_ma=sanpham.mancc AND nhacungcap.ncc_ma='$nccma'";
						$kq1 = mysqli_query($con,$dulieu1);
			}		
		}
	} 
		$dulieu3 = "SELECT * FROM sanpham";
		$kq3 = mysqli_query($con,$dulieu3);
	
	
}
		else {
			header('Location:../index.php');
		}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title> Đặt hàng  </title>
	<link rel="stylesheet" href="../all.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
	<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
</head>
<body>
	<header> <h1>HT quản lý nhà cung cấp vận chuyển</h1> </header>
	<?php include("../includes/menu_admin.php") ?>

		<h1>Đặt hàng</h1>
		<div class="container"
		>
		<form action="" method="POST">
				<fieldset class="form-group row">
				<label for="a2">Chọn nhà cung cấp: </label>
				<div class="input-box">
			<select class="custom-select" name="chonncc" id="chonncc" required>
				<option value="" disabled selected>--Chọn--</option>
				<?php $i=1; while($mangdl = mysqli_fetch_array($kq)) { ?>
			  <option value="<?php echo $mangdl['ncc_ma'] ?>"><?php echo $mangdl['ncc_ten']?> : <?php echo $mangdl['ncc_ma'] ?></option>
				<?php $i++; } ?>
			</select>	
			</div>
			<input type="submit" class="btn btn-success" value="Tìm kiếm">
			</fieldset>
			</form><!--  end form chọn nhà cung cấp -->

		<form action="them_don.php" method="POST" id="bang" style="display:none;">

			<fieldset class="form-group row">
				<label for="a2">Chọn nhà vận chuyển:</label>
				<div class="input-box">
			<select class="custom-select" name="nvc_ma" id="nvc_ma" required>
				<option value="" disabled selected>--Chọn--</option>
				<?php $i=1; while($mangdl2 = mysqli_fetch_array($kq2)) { ?>
			  <option value="<?php echo $mangdl2['nvc_ma'] ?>"><?php echo $mangdl2['nvc_ten']?> : <?php echo $mangdl2['nvc_ma'] ?></option>
			  <?php $_SESSION['manvc']=$mangdl2['nvc_ma'] ?>
				<?php $i++; } ?>
			</select>	
			</div>		
			</fieldset>
			<div class="btn btn-danger" id="danhsach">Xem danh sách sản phẩm</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx">
				
				 <thead>
			<tr>
				<th> Mã sản phẩm </th>
				<th> Ảnh</th>
				<th> Tên </th>
				<th> Loại </th>
				<th> Giá </th>
				<th> Mã nhà cung cấp </th>
				<th>Tên nhà cung cấp</th>
				<th> Số lượng trong kho </th>
				<th> Nhập số lượng lấy </th>
				<th> Thành tiền </th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while($danhsach = mysqli_fetch_array($kq1)) { ?>
			<tr>
				<td> <?php echo $danhsach['sp_ma']; ?> </td>
				<td><img class="card-img-top img-fluid" src="<?php echo $danhsach['anh'] ?>" alt="Card image cap" style="width: 100px; height: 50px;"></td>
				<td> <?php echo $danhsach['sp_ten']; ?> </td>
				<td> <?php echo $danhsach['loai']; ?> </td>
				<td> <?php echo $danhsach['gia']; ?> </td>
				<td> <?php echo $danhsach['mancc']; ?> </td>
				<td> <?php echo $danhsach['ncc_ten']; ?> </td>
				<td> <?php echo $danhsach['soluong'];?> </td>

				<td> <input type="text" class="col-12 soluong" id="<?php echo $danhsach['sp_ma']; ?>" name="<?php echo "txtsoluong".$danhsach['sp_ma']; ?>"> </td>

				<td> <div id="<?php echo "thanhtien".$danhsach['sp_ma']; ?>"></div> </td> 
			<?php $_SESSION['mancc']=$danhsach['mancc']; ?>

			</tr>
			<?php $i++; } ?>
			<tr>

				<td colspan="9" style="text-align:right; "> Tổng tiền: </td>
				<td> <input type="text" id="txtFinalAmount" name="tongtien" readonly="readonly"></td>
			</tr>
			</tbody>
		</table>
	</div>
		<input id="btnSubmit" type="submit" value="Đặt hàng" class="btn btn-success" />
		<input type="reset" class="btn btn-info" value="Làm mới">
		</form>

		<!-- danh sách toàn bộ sản phẩm -->
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable table-dark" id="xxx1">	
		<thead>
			<tr>
				<th> Mã sản phẩm </th>
				<th> Ảnh</th>
				<th> Tên </th>
				<th> Loại </th>
				<th> Giá </th>
				<th> Mã nhà cung cấp </th>
				<th> Số lượng trong kho </th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while($mangdl = mysqli_fetch_array($kq3)) { ?>
			<tr>
				<td> <?php echo $mangdl['sp_ma']; ?> </td>
				<td><img class="card-img-top img-fluid" src="<?php echo $mangdl['anh'] ?>" alt="Card image cap" style="width: 100px; height: 50px;"></td>
				<td> <?php echo $mangdl['sp_ten']; ?> </td>
				<td> <?php echo $mangdl['loai']; ?> </td>
				<td> <?php echo $mangdl['gia']; ?> </td>
				<td> <?php echo $mangdl['mancc']; ?> </td>
				<td> <?php echo $mangdl['soluong'];?> </td>
			</tr>
			<?php $i++; } ?>
			</tbody>
		</table>
	</div>

	</div> <!-- end container -->
	<?php
		include("../includes/footer.php");
	?>
	
	<script type="text/javascript" src="dathang.js"> </script>
	<?php include("../includes/footer.php") ?>
	<script type="text/javascript">
		<?php if ($kt==1): ?>
			$('#bang').show();
			$('#xxx1').hide();
		<?php endif ?>
		$('#danhsach').click(function(event) {
			$('#bang').hide();
			$('#xxx1').show();
		});
	</script>
</body>
</html>