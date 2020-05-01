
<!DOCTYPE HTML> 
   <html>
   <head>
    <title>Plumber</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="../scripts/search.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
      $(document).ready(function() {
    $('#submit_form_search').submit(function(ev){
        ev.preventDefault();
        $.ajax({
            type: "get",
            url: '../php_files/charset_php_js.php',
            data: $(this).serialize(),
            success: function(response)
            {
                let jsonData = JSON.parse(response);
                window.location.href = '../search.php/?q=' + encodeURIComponent(jsonData.data);
           }
       });
     });
    });

</script>


</head>
 <body>
    <!-- Image and text -->

<!-- First nav bar-->
 <div class = 'head_block1'>
   <div class = 'head_block1_div_a'>
    <a href="about.php" class = 'head_block1_a' style="margin-left: 10px;"> О компании </a>
    <a href="about.php" class = 'head_block1_a'> Доставка </a>
    <a href="about.php" class = 'head_block1_a'> Оплата </a>
    <a href="about.php" class = 'head_block1_a'> Контакты </a>

    </div>
 </div> 


<div class = 'head_block2'>
   <div class = 'head_block2_div'>
    <a href = '/'><img src = '../images/logo.jpg' style = ' margin-top:20px; margin-left: 10px;width: 10%; margin-right: 300px;'></a>
    <span style="font-size: 20px;">+7(999) 999 99 99</span>
   </div>
 </div> 

 <div class = 'head_block3' style = 'border-top: 1px solid #d3d3d3;'>
  <div class = 'head_block3_div'>
  <div class="form-inline">
  <a href = '../katalog.php'><button type="submit" class="btn btn-primary mr-sm-3 mb-0" style = ' margin-left:10px;width: 220px;'><b>Каталог товаров</b></button></a>
    <form method="get" id = "submit_form_search">
      <input type="text" class="form-control mr-sm-0" id = 'field1' name = "search" placeholder="Например, смесители" style = 'width: 500px;'>
       <button type="submit" class="btn btn-outline-primary mr-sm-4 mb-0" style = 'margin-right: 10px; width: 50px;'><img src = '../svg/search.svg'></button>
  </form>
  <button type="submit" class="btn btn-outline-primary mb-0" style = 'margin-right: 10px; width: 150px;'>
    <a href = 'lich_kab.php'>Личный кабинет</a></button>
      <button type="submit" class="btn btn-outline-primary mb-0" style = 'margin-right: 10px; width:155px;'><a href="basket.php">Корзина <span class="badge badge-primary badge-pill" style = 'background-color: white; color: black;' id = 'basket_val'>0</span></a></button>

</div>
     </div>
 </div> 



<div class = 'body_main'>

<div class = 'title_type_div' style="margin-left: 10px;">Ванны</div>





<div class = 'num_of_items_div_search' style="margin-left: 10px;">
    <div class = 'num_of_items_text_search'>
      <span>Найдено товаров: </span><span id = 'found_items'> </span>
    </div>
</div>



<div class = 'sort_block_div_search' style="margin-left: 580px;">
    <a href="katalog.php" id = 'a_popular'><div class = 'sort_by_div_search' id = 'popular' onclick="sort_func(this.id)"><span>по популярности</span></div></a>
    <a href="katalog.php" id = 'a_desevle'><div class = 'sort_by_div_search' id = 'deshevle' onclick="sort_func(this.id)" style="margin-left: 46%;"><span>дешевле</span></div></a>
    <a href="katalog.php" id = 'a_doroje'><div class = 'sort_by_div_search' id = 'doroje' onclick="sort_func(this.id)" style="margin-left: 72%;"><span>дороже</span></div></a>
</div>


<div id = 'php_res' style="margin-left: 7px;">

</div>



</div>


<div id = 'no_res' class = 'no_res_div'>
  <div class = 'no_res_main_data'>
    <span style = 'font-size: 30px; margin-top: 100px; color: grey; position: absolute;'>По вашему запросу ничего не найдено </span>
  </div>
</div>


<div class = 'bottom_to_paste' id = 'bot_div' style = 'margin-top: 0px;   position: absolute; width: 100%; height: 30%;'>
  <div class = 'bottom_div'>  
    <div class = 'bottom_sub_div'>
      
      <div style = 'float: left;'>
        <div>
          <img src = '../images/logo.jpg' style="width: 10%; margin-top: 80px; margin-left: 20px;">
        </div>
        <div style="width:100px; font-size: 13px;margin-left: 10px; text-align: center;">
          <span>территориальное управление Кутузовское</span>
        </div>
      </div>
    <div style="margin-left: 400px; margin-top: 80px; position: absolute;">
      <div><a href="#">Каталог</a></div>
      <div><a href="#">Каталог</a></div>
      <div><a href="#">Каталог</a></div>
    </div>

    <div style="margin-left: 600px; margin-top: 80px; position: absolute;">
      <div><a href="#">Каталог</a></div>
      <div><a href="#">Каталог</a></div>
      <div><a href="#">Каталог</a></div>
    </div>
    <div style="margin-left: 900px; margin-top: 80px; position: absolute;">
        <div>
          <span>Мы принимаем к оплате</span>
        </div>
        <div> 
          <center><img src = '../svg/visa.svg'><img src = '../svg/mastercard.svg'></center>
        </div>
    </div>

    </div>
  </div>

</div>

</body>


</html>



