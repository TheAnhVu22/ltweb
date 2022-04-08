<?php
	include("includes/config.php");
	session_start();
	if(isset($_SESSION['sessUsername']) && $_SESSION['sessUsername']!=NULL) {
		 unset($_SESSION['sessUsername']);
		  header('Refresh:0;url="index.php"');
	}
	else {
			header('Location:../index.php');
	}
?>