<?php
	error_reporting(0);
	require("../includes/config.php");
	session_start();
		if(isset($_SESSION['nhavanchuyen_login']) && $_SESSION['nhavanchuyen_login'] == true){
			$ma = $_GET['id'];
				$xacnhan = "UPDATE donhang SET giaohang=1 WHERE dh_ma='$ma'";
				$kq=mysqli_query($con,$xacnhan);

					header( "refresh:0;url=index.php" );

		}
	else {
		header('Location:../index.php');
	}
?>