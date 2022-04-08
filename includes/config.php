<?php
$host='localhost';
$user='root';
$pass='';
$ten_db='ltweb';

$con=mysqli_connect($host, $user, $pass, $ten_db);

if (mysqli_connect_errno()){
	echo "Kết nối tới MySQL thất bại: " . mysqli_connect_error();
}
	
?>