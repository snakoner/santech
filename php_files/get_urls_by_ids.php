<?php

	include 'funcs_data_base.php';
	$ids = $_POST['ids'];
	$curr_page = $_POST['curr_page'];
	//$link = uSetConnection(host, username, passw);
    $string_ids = '(';
    for($i = 0; $i < count($ids); $i++){
    	$string_ids .= (string)$ids[$i].',';
    }
    $string_ids = substr($string_ids, 0,-1);
    $string_ids .= ')';


    $query = 'SELECT * from `product_info_tb` where id IN '.$string_ids.';';
    $link = uSetConnection(host, username, passw);
    mysqli_select_db($link, cat_db_name);
    $res = mysqli_query($link, $query);
	$ids = '';
    $names = '';
    $urls = '';
    $prices = '';
    while($row = mysqli_fetch_assoc($res)){
     	$ids .= $row['id'].'=';
     	$names .= $row['name'].'=';
     	$urls .= $row['photo'].'=';
     	$prices .= $row['price'].'=';     	
     }
    $ids = substr($ids, 0,-1);
    $names = substr($names, 0,-1);
    $urls = substr($urls, 0,-1);
    $prices = substr($prices, 0,-1);
    mysqli_close($link);

    echo json_encode(array('names' => $names, 'urls' => $urls, 'prices' => $prices));


?>