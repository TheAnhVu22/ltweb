<?php
	
	function validate_name($name) {
		if(preg_match("/^[a-zA-Z ]{2,50}$/",$name)) {
			return true;
		}
		else {
			return "chỉ bao gồm chữ không dấu";
		}
	}
	function validate_password($password) {
		if(strlen($password) > 4 && strlen($password) < 31) {
			return true;
		}
		else {
			return "mật khẩu có độ dài 5-30 ký tự";
		}
	}
	function validate_phone($phone) {
		if(preg_match("/^[0-9]{10}$/",$phone)) {
			return true;
		}
		else {
			return "Sđt chỉ gồm 10 chữ số";
		}
	}
	function validate_number($number) {
		if(preg_match("/^[0-9]*$/",$number)) {
			return true;
		}
		else {
			return "chỉ được phép số";
		}
	}
	function validate_price($price) {
		if(preg_match("/^[0-9.]*$/",$price)) {
			return true;
		}
		else {
			return "chỉ được phép số";
		}
	}
	function validate_username($username) {
		if(preg_match("/^[a-zA-Z0-9]{5,14}$/",$username)) {
			return true;
		}
		else {
			return "5-14 ký tự, chỉ bao gồm chữ và số";
		}
	}
	function validate_email($email) {
		//bộ lọc kiểm tra email có hợp lệ không
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		else {
			return "Email không hợp lệ";
		}
	}
?>