<?php
	include 'funcs_data_base.php';
	 $search_input = mb_strtolower($_POST['id']);
	 $link = uSetConnection(host, username, passw);
     mysqli_select_db($link, cat_db_name);
     $query = "SELECT * FROM `product_info_tb` WHERE LOWER(name) LIKE '%".$search_input."%';";
     $res = mysqli_query($link, $query);
     $out_string = '';
     if (mysqli_num_rows($res)){
     	while($row = mysqli_fetch_assoc($res)){
     		$out_string .= $row['id'].'#';
     	}
     	$out_string = substr($out_string, 0,-1);

     }
     else{
     	$out_string = '-';
     }
     mysqli_close($link);
	echo json_encode(array('data' => $out_string));
?>