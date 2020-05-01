<?php
		include 'funcs_data_base.php';
		$login = $_POST['login'];
		$password = $_POST['password'];

       	$json_data_out = 0;

       	if (!uRegExprEmail($login)){
             	$json_data_out = 0;
                  echo json_encode(array('success' => $json_data_out));
                  return;
       	}
       	$res = uCheckAccountInDB($login, $password);
       	if (!$res){
             	$json_data_out = 0;
                  echo json_encode(array('success' => $json_data_out));
                  return;
       	}
       	else if ($res){
       		if (!uCheckPasswordInDB($login, $password))
                        $json_data_out = 0;
       		else
       	 	        $json_data_out = 1;
            }
	     echo json_encode(array('success' => $json_data_out, 'login' => $login));
           return;
?>