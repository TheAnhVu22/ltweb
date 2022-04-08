<?php
	error_reporting(0);
	require("../includes/config.php");
	session_start();
		if(isset($_SESSION['nhacungcap_login']) && $_SESSION['nhacungcap_login'] == true){
			$ma = $_GET['id'];
			$dulieu = "SELECT *,sanphamdat.soluong as soluong1,sanpham.soluong as soluong2 FROM donhang,sanphamdat,sanpham WHERE sanphamdat.madh='$ma' AND sanphamdat.masp=sanpham.sp_ma AND sanphamdat.madh=donhang.dh_ma";
			$kq1 = mysqli_query($con,$dulieu);
			$i=1; while($mangdl = mysqli_fetch_array($kq1)){ 
				$masp=$mangdl['sp_ma'];
				$sl= $mangdl['soluong2']-$mangdl['soluong1'];
				$capnhat = "UPDATE sanpham SET soluong='$sl' WHERE sp_ma='$masp'";
				$kq2=mysqli_query($con,$capnhat); 
			$i++; }
				  $xacnhan = "UPDATE donhang SET trangthai=1 WHERE dh_ma='$ma'";
				  $kq=mysqli_query($con,$xacnhan);
				  header( "refresh:0;url=donhang.php" );
		}
	else {
		header('Location:../index.php');
	}
?>