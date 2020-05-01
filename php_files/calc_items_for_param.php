<?php 
	include 'funcs_data_base.php';
	$param = $_POST['param_t'];
	$data =  $_POST['param_d'];
	
	$link = uSetConnection(host, username, passw);
	mysqli_select_db($link, cat_db_name);
	$query = '';
	$n_items = 0;

	if ($data != ''){
		$data = explode('#', $data);
		for($i = 0; $i < count($data); $i++){
			$data[$i] = explode('_', $data[$i])[1];
		}

		for($i = 0; $i < count($data); $i++){
			$query = "SELECT ".$param." FROM `product_info_tb` WHERE ".$param." = '".$data[$i].'\';';
			$res = mysqli_query($link, $query);
			$n_items += mysqli_num_rows($res);
		}
	}
	else{
		$query = "SELECT ".$param." FROM `product_info_tb` where ".$param." IS NOT NULL;";
		$res = mysqli_query($link, $query);
		$n_items = mysqli_num_rows($res);

	}
	mysqli_close($link);

	echo json_encode(array('n_items' => $n_items, 'res'=>$query));

?>