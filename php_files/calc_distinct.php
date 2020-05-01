<?php 
	include 'funcs_data_base.php';
	$type_id = $_POST['id'];
	$link = uSetConnection(host, username, passw);
    mysqli_select_db($link, cat_db_name);
    $query = "SELECT DISTINCT ".$type_id." FROM `product_info_tb`;";
    $res = mysqli_query($link, $query);
    mysqli_close($link);

    $out_brands = '';

    while($row = mysqli_fetch_assoc($res)){
    	$brand = $row[$type_id];
    	if ($brand)
	    	$out_brands .= $row[$type_id].'#';
    }
    $out_brands = substr($out_brands, 0,-1);

	echo json_encode(array('sub_types' => $out_brands));

?>