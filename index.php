
<!DOCTYPE HTML> 
   <html>
   <head>
    <title>Plumber</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="scripts/index.js"></script>

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
            url: 'php_files/charset_php_js.php',
            data: $(this).serialize(),
            success: function(response)
            {
                let jsonData = JSON.parse(response);
                window.location.href = 'search.php/?q=' + encodeURIComponent(jsonData.data);
           }
       });
     });
    });


  document.addEventListener('DOMContentLoaded', onload_page);
</script>



</head>
<body>


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
    <a href = '/'><img src = 'images/logo.jpg' style = ' margin-top:20px; margin-left: 10px;width: 10%; margin-right: 300px;'></a>
    <span style="font-size: 20px;">+7(999) 999 99 99</span>
   </div>
 </div> 

 <div class = 'head_block3' style = 'border-top: 1px solid #d3d3d3;'>
  <div class = 'head_block3_div'>
  <div class="form-inline">
  <a href = 'katalog.php'><button type="submit" class="btn btn-primary mr-sm-3 mb-0" style = ' margin-left:10px;width: 220px;'><b>Каталог товаров</b></button></a>
    <form method="get" id = "submit_form_search">
      <input type="text" class="form-control mr-sm-0" id = 'field1' name = "search" placeholder="Например, смесители" style = 'width: 500px;'>
       <button type="submit" class="btn btn-outline-primary mr-sm-4 mb-0" style = 'margin-right: 10px; width: 50px;'><img src = 'svg/search.svg'></button>
  </form>
  <button type="submit" class="btn btn-outline-primary mb-0" style = 'margin-right: 10px; width: 150px;'>
    <a href = 'lich_kab.php'>Личный кабинет</a></button>
      <button type="submit" class="btn btn-outline-primary mb-0" style = 'margin-right: 10px; width:155px;'><a href="basket.php">Корзина <span class="badge badge-primary badge-pill" style = 'background-color: white; color: black;' id = 'basket_val'>0</span></a></button>

</div>
     </div>
 </div> 




<div class = 'carousel_div'>
<ul id="slides">
  <li class="slide change" id = 'slide1'></li>
  <li class="slide"  id = 'slide2'></li>
  <li class="slide" id = 'slide3'></li>
</ul>
</div>

<div class = 'place-for-callback'>
</div>


</body>


</html>
