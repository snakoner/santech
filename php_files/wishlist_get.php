<?php
	$ids = $_POST['id'];	
	$curr_page = $_POST['curr_page'];
	echo json_encode(array('data' => $ids));

 ?>