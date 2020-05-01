<?php 
	include 'funcs_data_base.php';
	$type_id = $_POST['id'];
	$res = uCalculateNumOfItemByID($type_id);
	echo json_encode(array('name' => $res));

?>