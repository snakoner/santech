<?php 
	include 'funcs_data_base.php';
	$type_id = $_POST['id'];
	$link = uSetConnection(host, username, passw);
    mysqli_select_db($link, cat_db_name);
    $query = "SELECT DISTINCT brand FROM `product_info_tb` WHERE type_id = ".$type_id.';';
    $res = mysqli_query($link, $query);
    $out_brands = '';
    while($row = mysqli_fetch_assoc($res)){
    	$brand = $row['brand'];
    	if ($brand)
	    	$out_brands .= $row['brand'].'#';
    }
    $out_brands = substr($out_brands, 0,-1);

	echo json_encode(array('brands' => $out_brands));

?>