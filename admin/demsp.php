<?php
	require("../includes/config.php");
	$sql = "SELECT sp_ma FROM sanpham ORDER BY sp_ma DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	echo $row[0];
?>