<?php 
	include 'funcs_data_base.php';
	$param = $_POST['param_t'];
	$data =  $_POST['param_d'];
	$query = '';
	$prev_query = '';
	$par_size = count($param);
	for($i = 0; $i < $par_size; $i++){
		$split = explode('#', $data[$i]);
		$sp_size = count($split);
		$query .= '(SELECT * FROM `product_info_tb`'.$prev_query.' WHERE ';
		if ($i  - 1 >= 0){
			$query = '(SELECT * FROM '.$prev_query.' WHERE ';
		}
		for($k = 0; $k < $sp_size; $k++){
			$query .= $param[$i].' = "'.$split[$k].'" ';
			if ($k + 1 != $sp_size){
				$query .= ' OR ';
				}
		}
		if ($i + 1 != $par_size)
			$query .= ') AS x_'.$i;
		$prev_query = $query;
		$query = '';
	}
	$prev_query .= ';';
	$prev_query = substr($prev_query,1);
	$link = uSetConnection(host, username, passw);
    mysqli_select_db($link, cat_db_name);
    mysqli_set_charset($link, "utf8");
	$res = mysqli_query($link, $prev_query);
	$num = mysqli_num_rows($res);
	mysqli_close($link);

	echo json_encode(array('param' => 0, 'data' => $num));

?>