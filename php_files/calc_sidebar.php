<?php
	include 'funcs_data_base.php';
	$cats_arr = array(
    'vanni'  => 1,
    'plitki' => 2,
    'smesiteli' => 3);
    foreach ($cats_arr as $key => $value) {
    	$res = uCalculateNumOfItemByID($value);
    	$cats_arr[$key] = $res;
    }

    echo json_encode(array('vanni' => $cats_arr['vanni'], 'plitki' => $cats_arr['plitki'], 'smesiteli'=>$cats_arr['smesiteli']));
?>