<?php
require("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])&&$_SESSION['admin_login'] == true){
	$ngay = date('Y-m-d');
	$ma = $_SESSION['ma'];
	$dulieu = mysqli_query($con,"SELECT sp_ma,soluong FROM sanpham ORDER BY sp_ma DESC LIMIT 1");
	$row=mysqli_fetch_array($dulieu);
	// tổng sản phẩm hiện có
	$Tongsanpham = $row[0];
	$kt=1;
	$mangsl = array();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!empty($_POST['tongtien'])){
			$tongtien = $_POST['tongtien'];
			$manvc = $_SESSION['manvc'];
			$mancc = $_SESSION['mancc'];

			for($i=1;$i<=$Tongsanpham;$i++){
				if (isset($_POST['txtsoluong'.$i]) && $_POST['txtsoluong'.$i]!=NULL) {
					$mangsl[$i] = $_POST['txtsoluong'.$i];
					$sql = "SELECT soluong FROM sanpham WHERE sp_ma='$i'";
				
				 $mang=mysqli_fetch_array(mysqli_query($con,$sql));
				  if ($mangsl[$i]>$mang['soluong']) {
				  	$kt=0;
				  	echo "<script> alert('Số lượng nhập phải nhỏ hơn số lượng trong kho'); </script>";
			 	 	header('Refresh:0;url=dathang_them.php');
				  }
				}
			}
		}
		else{
			echo "Tổng tiền trống";
		}
	}
	if ($kt==1) {
		$sql1 = "INSERT INTO donhang(ngay,trangthai,tongtien,mand,mancc,manvc) VALUES('$ngay','0','$tongtien','$ma','$mancc','$manvc')";
	 if($con->query($sql1) === true){
	 	$sqldonhang = "SELECT dh_ma FROM donhang ORDER BY dh_ma DESC LIMIT 1";
	 	$ketquadonhang = mysqli_query($con,$sqldonhang);
	 	$dulieudonhang =mysqli_fetch_array($ketquadonhang);
	 	$dh_ma = $dulieudonhang[0];
	 	foreach($mangsl as $masp => $soluongsp){
	 		if($soluongsp != NULL){
	 			$sql2 = "INSERT INTO sanphamdat(soluong,madh,masp) VALUES('$soluongsp','$dh_ma','$masp')";
	 			if($con->query($sql2) === true){
	 			}
	 			else {
	 				echo "Lỗi !";
	 			}
	 		}
	 	}
	 }
	  else{
	  	echo "Thêm đơn hàng thất bại";
	  }
	  header('Location:dathang.php');
	}
	 
	  }
	 else {
	 		header('Location:../index.php');
	 	}	
	  

?>