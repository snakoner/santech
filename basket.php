
<!DOCTYPE HTML> 
   <html>
   <head>
    <title>Best Santechnic Zel</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>


<script type="text/javascript">

	function create_sharp_string(arr){
		string = "";
		for(let i = 0; i < arr.length; i++){
			string += '#' + arr[i];
		}
		return string;	
	}
	function find_all_uniques(){
		let arr = [];
		let purchases = localStorage.getItem('purchases');
		let splitted_data = purchases.split('#');
		let all_ids = [];
		let all_insertions = [];
		for(let i = 1; i < splitted_data.length; i++){
				if (arr.indexOf(splitted_data[i]) == -1){
					arr.push(splitted_data[i]);
					arr.push(0);
					all_ids.push(splitted_data[i]);

				}		
		}
		for(let i = 1; i < splitted_data.length; i++){
			let index = arr.indexOf(splitted_data[i]);
			arr[index + 1] += 1;
		}
		for(let i = 1; i < arr.length; i+=2){
			all_insertions.push(arr[i]);
		}
		return [create_sharp_string(all_ids), all_insertions];
	}
	function calc_sum_price(nums, prices){
		sum = 0;
		for(i = 0; i < prices.length; i++)
			sum += Number(insertions[i])*Number(prices[i]);
		return sum;
	}
    function onload_page(){
          let purchases = localStorage.getItem('purchases');
          //show_wish_list();
          //let vec = purchases.split('#');
          //localStorage.setItem('in_basket', 0);
				change_basket_text();
          if (localStorage.getItem('in_basket') == '0'){
          }
          else{
	          tmp_res = find_all_uniques();	
	          purchases = tmp_res[0];
	          insertions = tmp_res[1];

	          $.ajax({
	              type: "POST",
	              url: 'php_files/basket_get_info.php',
	              data: { 
		        		id: purchases,
		      		},
	              success: function(response)
	                {
	                	let html_data = '';
	                	let jsonData = JSON.parse(response);
	                	splitted_data = jsonData.names.split('=');
	                	prices = jsonData.prices.split('=');	                	
	                	purchases = purchases.slice(1);
	                	ids = purchases.split('#');
	                	html_data += '<table id = "table" class = "tbl_of_purchases">';
	                	html_data += '<tr><th>Наименование товара</th><th>Количество</th><th>Цена</th><th>Итого</th></tr>';
	                	for(let i = 0; i < splitted_data.length; i++){
	                		html_data += '<tr id = "tr_'+ids[i]+'"><td class = \'td_style\'>' + splitted_data[i] + '</td><td class = \'td_style\'><button style = "margin-left: 10px; float:left;" id = "-_' + ids[i] + '" class = "btn-primary btn-sm" onclick = "change_quantity(this.id, splitted_data)">-</button> <div style = "float:left; margin-left: 10px;" id = "val_'+ ids[i] +'"> ' + insertions[i] + ' </div> <button  id = "+_' + ids[i] + '" class = "btn-primary btn-sm" style = "float:left; margin-left: 10px;" onclick = "change_quantity(this.id)">+</button></td><td class = \'td_style\' id = "price_'+ids[i] +'">' + prices[i] + '</td>' +'<td class = \'td_style\' id = "itogo_'+ids[i] +'">' + insertions[i]*prices[i] + '</td>'+ '</tr>';
	                	}

	                	html_data += '<tr><th>Итого</th><th></th><th></th><th id = "itogo_price">'+calc_sum_price(insertions, prices).toString()+'</th></tr>';
	                	html_data += "</table>";
	                	document.querySelector('#div_table').innerHTML = html_data;
	                	ids_local_storage = '';
	                	for(i = 0; i < ids.length; i++){
	                		ids_local_storage += ids[i] + '#';
	                	}
	                	localStorage.setItem('ids', ids_local_storage);
	               }
	         });
         }     
	}
</script>

<script type="text/javascript">
	function change_quantity(val, splitted){
		btn_data = val.split('_');

		if (btn_data[0]=='-'){
			let element = document.querySelector('#val_' + btn_data[1]);
			if (element.innerHTML > 1){
				element.innerHTML = Number(element.innerHTML) - 1;
				document.querySelector('#itogo_' + btn_data[1]).innerHTML = Number(document.querySelector('#itogo_' + btn_data[1]).innerHTML) - Number(document.querySelector('#price_' + btn_data[1]).innerHTML);
			}
			else if(element.innerHTML == 1){
				document.querySelector("#tr_" + btn_data[1]).remove();
				let tmp = localStorage.getItem('ids');
				tmp = tmp.replace('#' + btn_data[1], '');
				localStorage.setItem('ids', tmp);
			}
			
		}
		else{
			document.querySelector('#val_' + btn_data[1]).innerHTML = Number(document.querySelector('#val_' + btn_data[1]).innerHTML) + 1;
			//alert(document.querySelector('#itogo_' + btn_data[1]).innerHTML);
			document.querySelector('#itogo_' + btn_data[1]).innerHTML = Number(document.querySelector('#itogo_' + btn_data[1]).innerHTML) + Number(document.querySelector('#price_' + btn_data[1]).innerHTML);
		}
		change_loc_stor_purchases(btn_data[0], btn_data[1]);
		change_basket_text(btn_data[0]);
		let ids = localStorage.getItem('ids');
		ids_splitted = ids.split('#');
		let sum = 0;
		for(let i = 0; i < ids_splitted.length - 1; i++){
			let index = Number(ids_splitted[i]);
			sum += Number(document.querySelector('#itogo_' + ids_splitted[i]).innerHTML);
		}
		document.querySelector('#itogo_price').innerHTML = sum.toString();
	}
	function change_loc_stor_purchases(action, id){
		let tmp = localStorage.getItem('purchases');
		if (action == '-')
			tmp = tmp.replace('#' + (id), "");
		else
			tmp += '#' + (id);
		localStorage.setItem('purchases', tmp);
	}
	function change_basket_text(action){
		let tmp = localStorage.getItem('in_basket');
		if (action == '-')
			tmp = (Number(tmp) - 1).toString();
		else if (action == '+')
			tmp = (Number(tmp) + 1).toString();

		localStorage.setItem('in_basket', tmp);
		document.querySelector('#basket_val').innerHTML = tmp;
		if (tmp == '0'){
			document.querySelector('#div_table').innerHTML = '<div style = "margin-left: 400px;">Ваша корзина пуста</div>';
		}
	}
</script>



<script type="text/javascript">

  function add_to_basket_func(val){
      var purchases = localStorage.getItem('purchases');
      let tmp_purch = '';
      if ((typeof purchases == 'undefined') || (purchases == null)){
          localStorage.setItem('purchases', '');
      }

      purchases = localStorage.getItem('purchases');
      tmp_purch += '#'+val.split('_')[1];
      tmp_purch += purchases;
      localStorage.setItem('purchases', tmp_purch);
      let n_items_in_basket = localStorage.getItem('in_basket');
      n_items_in_basket++;
      $("#basket_val").html(n_items_in_basket);
      localStorage.setItem('in_basket', n_items_in_basket);
  }
  function show_wish_list(){
  	let wishlist = localStorage.getItem('wishlist');
  	let vec_ids = '';
  	wishlist = wishlist.split('#');
  	var html_data = '';
  	for(let i = 0; i < wishlist.length; i++)
  		if (wishlist[i]!=''){
  			vec_ids += '#' + wishlist[i];
  		}
      $.ajax({
	              type: "POST",
	              url: 'php_files/basket_get_info.php',
	              data: { 
		        		id: vec_ids,
		      		},
	              success: function(response)
	                {
	                	let jsonData = JSON.parse(response);
	                	names = jsonData.names.split('=');
	                	prices = jsonData.prices.split('=');
					  	html_data += '<table class = "tbl_of_purchases">';
					  	html_data += '<tr><th>Наименование товара</th><th>Цена</th></tr>';

					  	for(let i = 0; i < names.length; i++)
					  		html_data += '<tr><td = class = "td_style">' + names[i] + '</td>' + '<td>' + prices[i] + '</td>' + '</tr>';
					  	
					  	html_data += '</table>';
					  	var x = html_data;
					  	document.querySelector('#wish').innerHTML = html_data;

	               }
	         });
  }


</script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', onload_page);
</script>


<style>
.div_table{
		position: absolute;
		margin-top: 300px;
		margin-left: 300px;
		width: 1000px;
		height: 200px;
	}
	.tbl_of_purchases{
		width: 90%; 
		text-align: center; 
		border-bottom: 2px solid #dfdfdf; 
		border: 2px solid #000000;
		border-radius: 6px; 
		border-collapse: separate; 
		border-spacing: 1px;
		}
	.td_style{
		border: 1px solid #dfdfdf;
	}
	.tr_style{

	}
  .nav_bar_div{
    margin-left: 100px;
    margin-right: 100px;
    float: left;
  }

  .nav_input_search_div{
    width: 300px;
    height: 20px;
  }
  .katalog_div{
      width: 850px;
      height: 500px;
      margin-top: 160px;
      margin-left: 400px;
      margin-right: 0px;
      position: absolute;
      border: 0px solid #a0a0a0; /* Параметры рамки */
      background: #ffffff;
  }

.katalog_div1{
      width: 850px;
      height: 420px;
      margin-top: 500px;
      margin-left: 400px;
      margin-right: 0px;
      position: absolute;
      border: 1px solid #a0a0a0; /* Параметры рамки */
      background: #ffffff;
  }

.image {
  width: 100%;
 }

.image img {
 -moz-transition: all 1s ease-out;
 -o-transition: all 1s ease-out;
 -webkit-transition: all 1s ease-out;
 }
 
.image img:hover{
 -webkit-transform: scale(1.7);
 -moz-transform: scale(1.7);
 -o-transform: scale(1.7);
 }
.image_box{
margin-top:5px; 
margin-left: 5px; 
overflow: hidden; 
width: 237px; 
 height: 270px;
}


.product-main:hover{
    -moz-box-shadow: 0 0 10px #000;
    -webkit-box-shadow: 0 0 10px #000;
    box-shadow:0 0 10px #000; 
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    transition: all 0.5s ease;
  }
.product-main{
    float: left;
    background: #ffffff;
    width: 250px;
    height: 430px;
    border: 1px solid #d1d1d1; /* Параметры рамки */
    margin-top: 50px;
    position: relative;
    margin-left: 20px;
  }
  .product-name-box{
    width: 200px;
    height: 30px;
    margin-left: 20px;
  }
  .product-name{
    font-size: 14px;
    margin-left: 10px;
  }

  .price{
  font-family: 'Impact';
  font-style: italic;
    font-size: 25px;
    margin-left: 90px;
  }
  .button_style_cat{
    margin-left: 10px;
  }
  .buy_block{
    width: 210px;
  }
 

/*
essential styles:
these make the slideshow work
*/
#slides{
  position: relative;
  height: 200px;
  padding: 0px;
  margin: 0px;
  list-style-type: none;
}

.slide{
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  opacity: 0;
  overflow: hidden;
  -webkit-transition: opacity 1s;
  -moz-transition: opacity 1s;
  -o-transition: opacity 1s;
  transition: opacity 1s;
}


.change{
  opacity: 1;
} 



/*
non-essential styles:
just for appearance; change whatever you want
*/



.carousel_div{
  margin-left: 30px;
  margin-top: 10px;
  margin-bottom: 20px;
  width: 1000px;
  height: 200px;
}



.slide{
  background: #000000;
  color: #ffffff;
}


.choose_price_div{
    margin-left: 100px;
    margin-top: 600px;
    float: left;
    width: 250px;
    position: absolute;
    height: 400px;
    background: white;
}

.sidebar_div{
    margin-left: 100px;
    margin-top: 150px;
    float: left;
    width: 250px;
    height: 400px;
    position: absolute;
    background: white;
  }

  .sidebar_href{
    margin-left: 20px;
    margin-top: 5px;
    position: relative;
    text-decoration: none;
  }
  .sidebar_href:hover{
    text-decoration: none;
  }

  .wish_list{
  	width: 1000px;
  	height: 500px;
  	background-color: white;
  	position: absolute;
  	margin-top: 500px;
  	margin-left: 300px;
  }
  </style>


   </head>   
   <body>

<div class = 'nav_bar_div'>
<!-- First nav bar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src = 'images/logo.jpg'/ style = 'width: 100px;'></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="about.php">О компании<span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dostavka.php">Доставка</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="oplata.php">Оплата</a>
        </li>   
        <li class="nav-item">
          <a class="nav-link" href="contacts.php">Контакты</a>
        </li>
      </ul>
    </div>
    <div>
      +7 (999) 984-70-53
    </div>
  </nav>

<!-- Second nav bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <div class="input-group-prepend">
                  <a href="katalog.php"><button type="submit" class="btn btn-dark  my-2 my-sm-0" style = 'width: 170px; background-color: #0000ff; border: none;'>Каталог товаров</button></a>
        </div>

      <div class="input-group-prepend">
        <input type="text" class="form-control mr-sm-2" id = 'field1' name = 'login' placeholder="Например, смесители" style="margin-left: 20px; width: 520px;">
        <button type="submit" class="btn btn-dark  my-2 my-sm-0">Найти</button>
      </div>

      <!--<ul class="nav justify-content-end" id = 'navbar_enter_tag' style = 'margin-left: 280px;'>
              <img src = "home.svg">
              <a class="nav-link" href="login_page.php" id = 'enter_a'>Войти</a>
      </ul> -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style = 'margin-left: 10px;'>
           <div class="input-group-prepend">
              <a href = 'login_page.php' style = 'text-decoration: none; color: white;'><button type="submit" class="btn btn-dark  my-2 my-sm-0" style = 'width: 150px; background-color: #0000ff; border: none;'>Личный кабинет</button></a>
          </div>
    </div>

    <div class="collapse navbar-collapse" id="navbarNavDropdown" style = 'margin-left: 10px;'>

           <div class="input-group-prepend">
              <a href="basket.php">
              <button type="submit" class="btn btn-dark  my-2 my-sm-0" style = 'width: 170px; background-color: #0000ff; border: none;'>Корзина <span class="badge badge-primary badge-pill" style = 'background-color: white; color: black;' id = 'basket_val'>0</span></button></a>
          </div>
    </div>
  </div>
  </nav>
</div>



   	<div class = 'div_table' id = 'div_table'>
   	
   </div>

   <div class = 'wish_list' id = 'wish'></div>


</body>



</html>
