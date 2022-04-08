<?php
	if(preg_match("/^[0-9.]*$/",$_POST['soluong'])){
		$soluong = $_POST['soluong'];
		$masp = $_POST['current_id'];
		require("../includes/config.php");
		$sql = "SELECT gia FROM sanpham WHERE sp_ma=$masp";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_array($result);
		$tongtien=$row["gia"]*$soluong;	
		echo (float)$tongtien;
	}
	else {
		echo "Chỉ được nhập số";
	}

?>