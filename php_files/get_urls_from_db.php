<?php  
	include 'funcs_data_base.php';
	 $curr_page = $_GET['page'];
	 $sort_type = $_GET['sort_type'];
     $link = uSetConnection(host, username, passw);
     mysqli_select_db($link, cat_db_name);
     $id_min = max_num_of_items_in_page*((int)$curr_page - 1) + 1;
     $id_max = $id_min + max_num_of_items_in_page;
     $query = '';
     if ($sort_type == '1'){
     	$query = 'SELECT * from `product_info_tb` '.' where '.'id >= '.(string)$id_min.' and '.'id <'.(string)$id_max.';';
     }
     else if ($sort_type == '2'){ //sort by price 0..n
     	$sort_type = 'price';
     	$query = 'select * from (SELECT (@row_number:=@row_number + 1) AS num, p.* from `product_info_tb` as p order by price) as x limit '.($id_min - 1).',28'.';';

     }
     else if ($sort_type == '3'){//sort by price n..0
     	$query = 'select * from (SELECT (@row_number:=@row_number + 1) AS num, p.* from `product_info_tb` as p order by price desc) as x limit '.($id_min - 1).',28'.';';
     }

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

    echo json_encode(array('names' => $names, 'urls' => $urls, 'ids'=> $ids, 'prices' => $prices, 'items_on_page' => max_num_of_items_in_page));

?>
