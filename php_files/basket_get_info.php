<?php
	include 'funcs_data_base.php';
	$id = $_POST['id'];
	$res = explode('#', $id);
	$prices = "";
	$names = "";
	for($i = 1; $i < count($res); $i++){
			$row = uGetRowFromDBByID((integer)$res[$i]);
			$names .= $row['name'].'=';
			$prices .= $row['price'].'=';

	}
	$names = substr($names, 0,-1);
	$prices = substr($prices, 0,-1);

	echo json_encode(array('names' => $names, 'prices'=> $prices));
 ?>