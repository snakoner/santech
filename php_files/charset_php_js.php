<?php 
	$val = $_GET['search'];
	echo json_encode(array('data' => $val));
?>