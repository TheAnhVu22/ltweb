<?php 
include("../includes/config.php"); 
$ma=$_GET['id'];
$xoa = "DELETE FROM nhacungcap WHERE ncc_ma='$ma'";
						$kiemtra = mysqli_query($con,$xoa);
					if(!$kiemtra) {
						echo "<script> alert(\"Xóa không thành công\"); </script>";
						 header('Refresh:0;url=nhacungcap.php');
					}
					else {
						header('Refresh:0;url=nhacungcap.php');
					}
?>