<?php 
	include 'funcs_data_base.php';
	$login = $_POST['login'];
	$passw = $_POST['password'];
	$passw_rep = $_POST['password_repeat'];
	$res = 0;
	if(uRegExprEmail($login) == 0){
		$res = 2;
	}
	else if ($passw!=$passw_rep){
		$res = 3;	
	}
	else{
		$res = 1;
	}

	echo json_encode(array('success' => $res, 'login' => $login, 'pass' => $passw));
	if ($res = 1){
		uAddAccoutToDB($login, $passw);
	}
 ?>